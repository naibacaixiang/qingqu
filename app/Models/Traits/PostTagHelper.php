<?php

namespace App\Models\Traits;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait PostTagHelper
{

    public function magicTag(Post $post,$type)
    {
        //插入数据之后得到post_id开始插入tags表和post-tag关系表
        //最后再插入user-tag关系表
        $id = $post->id;
        $user_id = Auth::id();

        //把输入进来的tag转成数组
        $tags = explode(',',$post->tags);

        //取tag表里所有tag为一列，并转成数组
        $tags_name = DB::table('tags')->pluck('name')->toArray();


        //登录用户使用过的tag,必须在插入新tag之前取值，不然会有本篇文章里的tag
        $auth_user_tags_id = DB::table('users_and_tags_relationships')->where('user_id',$user_id)
            ->pluck('tag_id')->toArray();

//            dd($auth_user_tags_id);
        $new_tags = array_diff($tags,$tags_name);
        $old_tags = array_intersect($tags,$tags_name);

//        $type = 'post';
//        dd();
        if($post->tags != NULL){

            foreach ($new_tags as $new_tag){
                //1、插入tag表，并更新计数
                DB::table('tags')->insert(['name' => $new_tag ]);
                DB::table('tags')->where('name',$new_tag)
                    ->increment('post_count');
                //取得tag_id，并插入关系表
                $new_tag_id = DB::table('tags')->where('name', $new_tag)->value('id');//       插入关系表
                DB::table('posts_and_tags_relationships')
                    ->insert(['post_id' => $id ,'tag_id' => $new_tag_id ,'type' => $type]);

                DB::table('users_and_tags_relationships')
                    ->insert(['user_id'=> $user_id,'tag_id' => $new_tag_id ,'type' => $type]);
                $relation_id = DB::table('users_and_tags_relationships')
                    ->where([['tag_id',$new_tag_id],['user_id',$user_id]])->value('id');
                DB::table('users_and_tags_relationships')->where('id',$relation_id)
                    ->increment('tag_count');
            }


            //处理old_tags

            foreach ($old_tags as $old_tag){
                DB::table('tags')->where('name',$old_tag)->increment('post_count');
                $old_tag_id = DB::table('tags')->where('name', $old_tag)->value('id');
                //       插入关系表
                DB::table('posts_and_tags_relationships')
                    ->insert(['post_id' => $id ,'tag_id' => $old_tag_id ,'type' => 'post']);
            }

            //当前文章已添加的tags_id ，这里$id就是$post_id
            $tags_id = DB::table('posts_and_tags_relationships')
                ->where('post_id',$id)->pluck('tag_id')->toArray();
            //        dd($tags_id);
            $old_tags_ids = array_intersect($tags_id,$auth_user_tags_id);
            //        dd($old_tags_ids);
            foreach ($old_tags_ids as $old_tags_id){
                $user_and_tag_id = DB::table('users_and_tags_relationships')
                    ->where([['tag_id',$old_tags_id],['user_id',$user_id]])->value('id');
                DB::table('users_and_tags_relationships')
                    ->where('id',$user_and_tag_id)->increment('tag_count');
            }

        }
    }
}