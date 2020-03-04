<?php

namespace App\Observers;

use App\Models\Post;
use App\Models\Traits\PostTagHelper;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class PostObserver
{


    public function created(Post $post)
    {
        //处理tag
        $post->magicTag($post,'post');


        $post_category_type = $post->category->type;
        //处理文章计数，根据category_type做判断
//        magicIncrement() 函数参数有，table，col，步长
        switch ($post_category_type) {
            case "bubble":
                $post->user->magicIncrement($post->user,'users','bubble_count');
                break;
            case "image":
                $post->user->magicIncrement($post->user,'users','image_count');
                break;
            default:
                $post->user->magicIncrement($post->user,'users','post_count');

        }
    }

    public function updating(Post $post)
    {
        //
    }

    public function saved(Post $post)
    {





    }


}

