@extends('layouts.default')

@section('title','冒泡标题？')

@section('content')


    <div class="col-lg-8 left">


        <div class="part post">

            <div class="post-title">

            </div>
            <div class="post-info">
                <span class="post-time">{{$bubble->created_at}}</span>
                <span class="post-user"><a href="{{route('user.show',$bubble->user)}}">{{$bubble->user->name}}</a></span>
                <span class="post-edit float-right">
          <a href="{{route('posts.edit',$bubble)}}" class="btn btn-success btn-sm">编辑</a>
        </span>
            </div>
            <div class="post-content">
                {!! $bubble->content !!}
            </div>

            <div class="post-tag"></div>



        </div>

    </div>


    @include('sidebar._home-sidebar')









@stop