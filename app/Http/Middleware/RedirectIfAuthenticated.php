<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            //目前有login 和 signup
            $message = $request->is('login') ? '您已登陆，无需该操作' : '您已注册并登录，无需该操作！';
            session()->flash('info', $message);
            return redirect('/');
        }

        return $next($request);
    }
}
