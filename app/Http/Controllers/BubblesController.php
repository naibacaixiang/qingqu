<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bubble;

use Vinkla\Hashids\Facades\Hashids;

class BubblesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request,Post $post)
    {
//        $this->validate($request, [
//            'content' => 'required|max:140'
//        ]);

        $post->fill($request->all());
        $post->user_id = Auth::id();
        $post->category_id = 1;
        $post->type = 'bubble';
        $user = Auth::user();
        $post->title = $user->name . ' 在 '. date('Y-m-d H:i') .' 冒了个泡';
        $post->save();

        session()->flash('success', '发布成功！');
//        return redirect()->route('post.show',[$post->category->slug,$post]);
        return redirect()->back();
    }



    public function destroy(Bubble $bubble)
    {
        $this->authorize('destroy', $bubble);
        $bubble->delete();
        session()->flash('success', '删除成功！');
        return redirect()->back();
    }

    public function show($id)
    {
        $bubble_id = current(Hashids::decode($id));
        $bubble = Bubble::find($bubble_id);

        if(! empty($bubble)  ){

            return view('bubbles.show',compact('bubble'));
        }else{
            return abort(404 );
        }


    }
}
