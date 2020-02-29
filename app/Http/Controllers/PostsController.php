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

	public function index()
	{
		$posts = Post::paginate();
		return view('posts.index', compact('posts'));
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

        $post->user_id = Auth::id();
        $post->category_id = 1;
        $post->save();

//      save()是保存到数据库。保存完成后，$user 会新增 id 这个属性，并赋上了保存的 id. 然后可以直接取值 详见：
//      \Illuminate\Database\EloquentModel@save : $saved = $this->performInsert($query)
//      \Illuminate\Database\EloquentModel@performInsert : $this->insertAndSetId($query, $attributes)
        //插入数据之后得到post_id开始插入tags表和关系表
        $id = $post->id;
        $tags = explode(',',$post->tags);

        $tags_name = DB::table('tags')->pluck('name')->toArray();

        $old_tags = array_intersect($tags,$tags_name);
        $new_tags = array_diff($tags,$tags_name);

        foreach ($new_tags as $new_tag){
            DB::table('tags')->insert(['name' => $new_tag ]);
            DB::table('tags')->where('name',$new_tag)->increment('post_count');
            $new_tag_id = DB::table('tags')->where('name', $new_tag)->value('id');//       插入关系表
            DB::table('posts_and_tags_relationships')
                ->insert(['post_id' => $id ,'tag_id' => $new_tag_id ,'type' => 'post']);
        }
        foreach ($old_tags as $old_tag){
            DB::table('tags')->where('name',$old_tag)->increment('post_count');
            $old_tag_id = DB::table('tags')->where('name', $old_tag)->value('id');
            //       插入关系表
            DB::table('posts_and_tags_relationships')
                ->insert(['post_id' => $id ,'tag_id' => $old_tag_id ,'type' => 'post']);
        }


		return redirect()->route('post.show',[$post->category->slug,$post])->with('message', '发表成功');
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

		return redirect()->route('post.show', [$post->category->slug,$post])->with('message', '更新成功');
	}

	public function destroy(Post $post)
	{
		$this->authorize('destroy', $post);
		$post->delete();

		return redirect()->route('posts.index')->with('message', 'Deleted successfully.');
	}
}