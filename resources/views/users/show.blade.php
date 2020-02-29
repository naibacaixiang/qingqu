





@extends('layouts.default')
@section('title', $user->name .'的个人中心')

@section('content')
    <div class="col-lg-8 left">



        <div class="part ">

            <span>全部</span>
            <span><a href="">冒泡</a></span>
            <span>收藏</span>
            <span></span>
            <span></span>

        </div>



    </div>







    @include('sidebar._home-sidebar')





@stop

