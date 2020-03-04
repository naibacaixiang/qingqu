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
        <span class="post-category"><a href="{{route('category.show',$post->category->slug)}}">{{$post->category->name}}</a></span>
        <span class="post-user"><a href="{{route('user.show',$post->user)}}">{{$post->user->name}}</a></span>
        <span class="post-edit float-right">
          <a href="{{route('post.edit',$post)}}" class="btn btn-success btn-sm">编辑</a>
        </span>
        <span class="post-del float-right">
          <a href="{{route('post.soft_delete',$post)}}" class="btn btn-danger btn-sm">删除</a>
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