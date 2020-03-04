<div class="col-lg-4 right">

    @if (Auth::check())
    <div class="part logout">

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-secondary logout">退出登录</button>
            {{--<a href="{{route('user.show'),$user}}" class="btn btn-dark user-center">个人中心</a>--}}
        </form>


    </div>
    @else
        <div class="part login-form">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">

                    <input type="email" name="email" class="form-control" placeholder="邮箱" aria-describedby="emailHelp">

                </div>
                <div class="form-group">

                    <input type="password" name="password" class="form-control" placeholder="密码" >
                </div>

                <button type="submit" class="btn btn-success login">登录</button>
                <a href="" class="btn btn-dark reg">注册</a>
                <a href="" class="btn btn-warning btn-sm forget-password float-right" >忘记密码</a>
            </form>
        </div>
    @endif

</div>