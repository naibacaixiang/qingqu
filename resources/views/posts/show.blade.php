@extends('layouts.default')

@section('title',$post->title)

@section('content')


  <div class="col-lg-8 left">


    <div class="part post">

      <div class="post-title">
        <h1>{{$post->title}}</h1>
      </div>
      <div class="post-info">
        <span class="post-time">{{$post->created_at}}</span>
        <span class="post-category">{{$post->category->name}}</span>
        <span class="post-user">{{$post->user->name}}</span>
        <span class="post-edit float-right">
          <a href="{{route('posts.edit',$post->id)}}" class="btn btn-success btn-sm">编辑</a>
        </span>
      </div>
      <div class="post-content">
        {!! $post->content !!}
      </div>

      <div class="post-tag"></div>



    </div>

  </div>


    @include('sidebar._home-sidebar')









@stop