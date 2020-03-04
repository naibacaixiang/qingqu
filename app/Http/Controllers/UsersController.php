<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['show', 'create', 'store','index','confirmEmail','followers','followings']
        ]);

        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }




    public function create()
    {
        return view('users.create');
    }

    public function magicPost(User $user,$type,$page)
    {
        $posts = $user->posts()->with('category','user')
            ->where('post_type',$type)->orderBy('created_at','desc')
            ->paginate($page);

        return $posts;
    }



    public function show(User $user)
    {
        $posts = $user->posts()->with('category','user')->orderBy('created_at','desc')->paginate(10);
//        $user = $user->with('posts');
        return view('users.show', compact('user','posts'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:users|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
//        Auth::login($user);
//        session()->flash('success', '欢迎，您将在这里开启一段新的旅程~');
//        return redirect()->route('users.show', [$user]);
        $this->sendEmailConfirmationTo($user);
        session()->flash('success', '验证邮件已发送到你的注册邮箱上，请注意查收。');
        return redirect('/');
    }


    protected function sendEmailConfirmationTo($user)
    {
        $view = 'emails.confirm';
        $data = compact('user');
        $from = 'summer@example.com';
        $name = 'Summer';
        $to = $user->email;
        $subject = "感谢注册 情趣 Plus ！请确认你的邮箱。";

        Mail::send($view, $data, function ($message) use ($from, $name, $to, $subject) {
            $message->from($from, $name)->to($to)->subject($subject);
        });
    }

    public function confirmEmail($token)
    {
        $user = User::where('activation_token', $token)->firstOrFail();

        $user->activated = true;
        $user->activation_token = null;
        $user->save();

        Auth::login($user);
        session()->flash('success', '恭喜你，激活成功！');
        return redirect()->route('users.show', [$user]);
    }


    public function edit(User $user)
    {

        $this->authorize('update', $user);
        return view('users.edit', compact('user'));

    }

    public function update(User $user, Request $request)
    {
        $this->authorize('update', $user);
        $this->validate($request, [
            'name' => 'required|max:50',
            'password' => 'required|confirmed|min:6'
        ]);

        $user->update([
            'name' => $request->name,
            'password' => bcrypt($request->password),
        ]);

        session()->flash('success', '个人资料更新成功！');

        return redirect()->route('users.show', $user->id);
    }




    public function followings(User $user)
    {
        $follow_users = $user->followings()->paginate(30);
        $title = $user->name . '关注的人';
        return view('users.follow', compact('follow_users', 'title','user'));
    }

    public function followers(User $user)
    {
        $follow_users = $user->followers()->paginate(30);
        $title = $user->name . '的粉丝';
        return view('users.follow', compact('follow_users', 'title','user'));
    }


}
