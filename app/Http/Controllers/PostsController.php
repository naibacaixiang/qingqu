<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use Vinkla\Hashids\Facades\Hashids;
use App\Handlers\ImageUploadHandler;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function show(Request $request ,$category ,$id)
    {
        $post_id = current(Hashids::decode($id));
        $post = Post::find($post_id);
        if(! empty($post) && $post->category->slug == $category ){

            return view('posts.show',compact('category','post'));
        }else{
            return abort(404 );
        }
    }


	public function create(Post $post)
	{
		return view('posts.create', compact('post'));
	}

	public function store(PostRequest $request,Post $post)
	{
//        store() 方法的第二个参数，会创建一个空白的 $post 实例；
//        $request->all() 获取所有用户的请求数据数组，如 ['title' => '标题', 'body' => '内容', ... ]
//        $post->fill($request->all()); fill 方法会将传参的键值数组填充到模型的属性中，如以上数组，$post->title 的值为 标题；
        $post->fill($request->all());
        $post->type = 'post';
        $post->user_id = Auth::id();
        $post->category_id = 2;
        $post->save();




//      save()是保存到数据库。保存完成后，$user 会新增 id 这个属性，并赋上了保存的 id. 然后可以直接取值,也就是insert_id
//      详见：\Illuminate\Database\EloquentModel@save : $saved = $this->performInsert($query)
//      \Illuminate\Database\EloquentModel@performInsert : $this->insertAndSetId($query, $attributes)
//        //插入数据之后得到post_id开始插入tags表和post-tag关系表
//        //最后再插入user-tag关系表
//
//        $id = $post->id;
//        $user_id = Auth::user()->id;
//
//
//        //把输入进来的tag转成数组
//        $tags = explode(',',$post->tags);
//
//        //取tag表里所有tag为一列，并转成数组
//        $tags_name = DB::table('tags')->pluck('name')->toArray();
//
//
//        //登录用户使用过的tag,必须在插入新tag之前取值，不然会有本篇文章里的tag
//        $auth_user_tags_id = DB::table('users_and_tags_relationships')->where('user_id',$user_id)
//            ->pluck('tag_id')->toArray();
//
////            dd($auth_user_tags_id);
//        $new_tags = array_diff($tags,$tags_name);
//        $old_tags = array_intersect($tags,$tags_name);
//
////        dd();
//        if($post->tags != NULL){
//
//            foreach ($new_tags as $new_tag){
//                //1、插入tag表，并更新计数
//                DB::table('tags')->insert(['name' => $new_tag ]);
//                DB::table('tags')->where('name',$new_tag)
//                    ->increment('post_count');
//                //取得tag_id，并插入关系表
//                $new_tag_id = DB::table('tags')->where('name', $new_tag)->value('id');//       插入关系表
//                DB::table('posts_and_tags_relationships')
//                    ->insert(['post_id' => $id ,'tag_id' => $new_tag_id ,'type' => 'post']);
//
//                DB::table('users_and_tags_relationships')
//                    ->insert(['user_id'=> $user_id,'tag_id' => $new_tag_id ,'type' => 'post']);
//                $relation_id = DB::table('users_and_tags_relationships')
//                    ->where([['tag_id',$new_tag_id],['user_id',$user_id]])->value('id');
//                DB::table('users_and_tags_relationships')->where('id',$relation_id)
//                    ->increment('tag_count');
//            }
//
//
//            //处理old_tags
//
//            foreach ($old_tags as $old_tag){
//                DB::table('tags')->where('name',$old_tag)->increment('post_count');
//                $old_tag_id = DB::table('tags')->where('name', $old_tag)->value('id');
//                //       插入关系表
//                DB::table('posts_and_tags_relationships')
//                    ->insert(['post_id' => $id ,'tag_id' => $old_tag_id ,'type' => 'post']);
//            }
//
//            //当前文章已添加的tags_id ，这里$id就是$post_id
//            $tags_id = DB::table('posts_and_tags_relationships')
//                ->where('post_id',$id)->pluck('tag_id')->toArray();
//    //        dd($tags_id);
//            $old_tags_ids = array_intersect($tags_id,$auth_user_tags_id);
//    //        dd($old_tags_ids);
//            foreach ($old_tags_ids as $old_tags_id){
//                $user_and_tag_id = DB::table('users_and_tags_relationships')
//                    ->where([['tag_id',$old_tags_id],['user_id',$user_id]])->value('id');
//                DB::table('users_and_tags_relationships')
//                    ->where('id',$user_and_tag_id)->increment('tag_count');
//            }
//
//        }

        session()->flash('success', '恭喜你，发表成功！');
		return redirect()->route('post.show',[$post->category->slug,$post]);
	}

	public function edit(Post $post)
	{
        $this->authorize('update', $post);
		return view('posts.edit', compact('post'));
	}

	public function update(PostRequest $request, Post $post)
	{

		$this->authorize('update', $post);

        $post_tags = explode(',',$post->tags);
        $update_tags = explode(',',$request->tags);

        $del_tags = array_diff($post_tags,$update_tags);
        $insert_tags = array_diff($update_tags,$post_tags);

        if($del_tags != NULL){
            foreach ($del_tags as $del_tag){
                $del_tag_id = DB::table('tags')->where('name', $del_tag)->value('id');
                DB::table('tags')->where('name',$del_tag)->decrement('post_count');
                DB::table('posts_and_tags_relationships')->where('tag_id',$del_tag_id)->delete();
            }
        }

        if($insert_tags != NULL){
            foreach ($insert_tags as $insert_tag){
                DB::table('tags')->insert(['name' => $insert_tag ]);
                DB::table('tags')->where('name',$insert_tag)->increment('post_count');
                $insert_tag_id = DB::table('tags')->where('name', $insert_tag)->value('id');
                //       插入关系表
                DB::table('posts_and_tags_relationships')
                    ->insert(['post_id' => $post->id ,'tag_id' => $insert_tag_id ,'type' => 'post']);
            }
        }


		$post->update($request->all());
        session()->flash('success', '恭喜你，更新成功！');
		return redirect()->route('post.show', [$post->category->slug,$post]);
	}

	//软删除
    public function softDeletes(Request $request)
    {
        //获取真实id
        $post_id = current(Hashids::decode($request->id));
        //软删除用原来删除方法就可以
        Post::destroy($post_id);
        session()->flash('success', '恭喜你，删除成功！');
        return redirect()->back();
    }



//	public function destroy(Post $post)
//	{
//		$this->authorize('destroy', $post);
//		$post->delete();
//
//		return redirect()->route('posts.index')->with('message', 'Deleted successfully.');
//	}



}