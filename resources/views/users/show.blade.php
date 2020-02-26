





@extends('layouts.default')
@section('title', $user->name)

@section('content')
    <div class="col-lg-8 left">



        <div class="part ">

            <span>全部</span>
            <span>冒泡</span>
            <span>收藏</span>
            <span></span>
            <span></span>

        </div>



    </div>







    @include('sidebar._home-sidebar')





@stop

