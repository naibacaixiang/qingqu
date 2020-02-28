<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{

    //前台只需要show方法
    public function show($category_slug)

    {
        //根据slug找到分类
        $categories = Category::where('slug', $category_slug)->get();

        //这个数据带过去为了category相关信息
        $category = $categories[0];

        //解决N+1的问题 预加载关联模型
        $posts = Post::with('user','category')
                        ->where('category_id',$category->id)
                        ->orderBy('created_at','desc')
                        ->paginate(10);

        return view('categories.show',compact('posts','category'));


    }
}
