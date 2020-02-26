<nav class="navbar fixed-top navbar-expand-md navbar-dark bg-dark navbar-offcanvas">


    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <ul class="navbar-nav navbar-top">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
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
                    <a href="" class="btn btn-success">登录</a>
                    <a href="" class="btn btn-dark">注册</a>


                </li>

            </ul>
        </div>
    </div>
</nav>



{{--<nav class="navbar navbar-expand-lg navbar-dark bg-dark">--}}
    {{--<div class="container ">--}}

        {{--<a class="navbar-brand" href="{{route('home')}}">Weibo App</a>--}}

        {{--<ul class="navbar-nav">--}}

            {{--<li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">用户列表</a></li>--}}
            {{--<li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">用户列表</a></li>--}}
            {{--<li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">用户列表</a></li>--}}
        {{--</ul>--}}

        {{--<ul class="navbar-nav justify-content-end">--}}
            {{--@if (Auth::check())--}}
                {{--<li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">用户列表</a></li>--}}
                {{--<li class="nav-item dropdown">--}}
                    {{--<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                        {{--{{ Auth::user()->name }}--}}
                    {{--</a>--}}
                    {{--<div class="dropdown-menu" aria-labelledby="navbarDropdown">--}}
                        {{--<a class="dropdown-item" href="{{ route('users.show', Auth::user()) }}">个人中心</a>--}}
                        {{--<a class="dropdown-item" href="{{ route('users.edit', Auth::user()) }}">编辑资料</a>--}}
                        {{--<div class="dropdown-divider"></div>--}}
                        {{--<a class="dropdown-item" id="logout" href="#">--}}
                            {{--<form action="{{ route('logout') }}" method="POST">--}}
                                {{--{{ csrf_field() }}--}}
                                {{--{{ method_field('DELETE') }}--}}
                                {{--<button class="btn btn-block btn-danger" type="submit" name="button">退出</button>--}}
                            {{--</form>--}}
                        {{--</a>--}}
                    {{--</div>--}}
                {{--</li>--}}
            {{--@else--}}
                {{--<li class="nav-item"><a class="nav-link" href="{{ route('help') }}">帮助</a></li>--}}
                {{--<li class="nav-item" ><a class="nav-link" href="{{ route('login') }}">登录</a></li>--}}
            {{--@endif--}}
        {{--</ul>--}}
    {{--</div>--}}
{{--</nav>--}}



