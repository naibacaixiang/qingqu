<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Vinkla\Hashids\Facades\Hashids;

class ImagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function create(Post $post)
    {
        return view('images.create', compact('post'));
    }

    public function store(Request $request,Post $post)
    {
//        $this->validate($request, [
//            'content' => 'required|max:140'
//        ]);

        $post->fill($request->all());

        $post->user_id = Auth::id();
        $post->category_id = 2;
        $user = Auth::user();
//        $post->title = $user->name . ' 在 '. date('Y-m-d H:i') .' 冒了个泡';
        $post->save();

        session()->flash('success', '发布成功！');
//        return redirect()->route('post.show',[$post->category->slug,$post]);
        return redirect()->route('post.show', [$post->category->slug,$post]);
    }
}
