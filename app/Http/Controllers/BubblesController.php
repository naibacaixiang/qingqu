<?php

namespace App\Http\Controllers;

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

    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:140'
        ]);

        Auth::user()->bubbles()->create([
            'content' => $request['content']
        ]);
        session()->flash('success', '发布成功！');
        return redirect()->back();
    }



    public function destroy(Bubble $bubble)
    {
        $this->authorize('destroy', $bubble);
        $bubble->delete();
        session()->flash('success', '微博已被成功删除！');
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
