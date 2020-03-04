<nav class="navbar fixed-top navbar-expand-md navbar-dark bg-dark navbar-offcanvas">

    @if (Auth::check())
    <div class="container-fluid qingqu-plus">
        <a class="navbar-brand" href="#">QingQu Plus</a>

        <ul class="navbar-nav navbar-top">
            <li class="nav-item active">
                <a class="nav-link" href="#">首页 <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://qingqu.test/notice">公告</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://qingqu.test/wallpaper">粉丝</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://qingqu.test/bubble">冒泡</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('user.show',$user)}}">个人中心</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('user.followers',$user)}}">粉丝</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('user.followings',$user)}}">关注</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right navbar-icon" type="button" data-toggle="collapse" data-target="#navbar-mobile" aria-controls="navbar-mobile" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar bar1"></span>
            <span class="icon-bar bar2"></span>
            <span class="icon-bar bar3"></span>
        </button>

        <div class="navbar-collapse collapse ml-auto" id="navbar-mobile">


                <ul class="navbar-nav ml-auto">

                    <li class="nav-image">
                        <img src="https://iph.href.lu/200x200" alt="">
                    </li>

                    {{$user->name}}

                    <li class="nav-item">
                        <a href="#!" class="nav-link">Link 1</a>
                    </li>
                    <li class="nav-item">
                        <a href="#!" class="nav-link">Link 2</a>
                    </li>
                    <li class="nav-item">
                        <a href="#!" class="nav-link">Link 3</a>
                    </li>


                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-secondary logout">退出登录</button>
                        <a href="{{route('user.show',$user)}}" class="btn btn-dark user-center">个人中心</a>
                    </form>


                </ul>

                {{--<ul class="navbar-nav ml-auto">--}}

                    {{--<li class="nav-image">--}}
                        {{--<img src="https://iph.href.lu/200x200" alt="">--}}
                    {{--</li>--}}

                    {{--<li class="nav-item">--}}
                        {{--<a href="#!" class="nav-link">Link 1</a>--}}
                    {{--</li>--}}
                    {{--<li class="nav-item">--}}
                        {{--<a href="#!" class="nav-link">Link 2</a>--}}
                    {{--</li>--}}
                    {{--<li class="nav-item">--}}
                        {{--<a href="#!" class="nav-link">Link 3</a>--}}
                    {{--</li>--}}

                    {{--<li class="nav-item login-reg">--}}
                        {{--<a href="{{route('login')}}" class="btn btn-success">登录</a>--}}
                        {{--<a href="{{route('signup')}}" class="btn btn-dark">注册</a>--}}
                    {{--</li>--}}

                {{--</ul>--}}





        </div>
    </div>
    @else
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <ul class="navbar-nav navbar-top">
                <li class="nav-item active">
                    <a class="nav-link" href="#">首页 <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://qingqu.test/notice">公告</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://qingqu.test/wallpaper">壁纸</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://qingqu.test/bubble">冒泡</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right navbar-icon" type="button" data-toggle="collapse" data-target="#navbar-mobile" aria-controls="navbar-mobile" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon-bar bar1"></span>
                <span class="icon-bar bar2"></span>
                <span class="icon-bar bar3"></span>
            </button>

            <div class="navbar-collapse collapse ml-auto" id="navbar-mobile">


                <ul class="navbar-nav ml-auto">

                    <li class="nav-image">
                        <img src="https://iph.href.lu/200x200" alt="">
                    </li>



                    <li class="nav-item">
                        <a href="#!" class="nav-link">Link 1</a>
                    </li>
                    <li class="nav-item">
                        <a href="#!" class="nav-link">Link 2</a>
                    </li>
                    <li class="nav-item">
                        <a href="#!" class="nav-link">Link 3</a>
                    </li>


                    <li class="nav-item login-reg">
                        <a href="{{route('login')}}" class="btn btn-success">登录</a>
                        <a href="{{route('signup')}}" class="btn btn-dark">注册</a>
                    </li>







            </div>
        </div>

    @endif
</nav>