<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bubble;

class StaticPagesController extends Controller
{

    public function home(User $user)
    {
//        $feed_items = [];
//        if (Auth::check()) {
//            $feed_items = Auth::user()->feed()->paginate(30);
//        }
//        dd($feed_items);


        $user = Auth::user();


//        return 123;
        return view('static_pages/home',compact('user'));

    }

    public function help()
    {
        return view('static_pages/help');
    }

    public function about()
    {
        return view('static_pages/about');
    }

}
