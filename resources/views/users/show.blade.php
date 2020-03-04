@extends('layouts.default')
@section('title', $user->name .'的个人中心')

@section('content')
    <div class="col-lg-8 left">



        <div class="part ">

            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-pink">全部</button>
                <button type="button" class="btn btn-pink">冒泡</button>
                <button type="button" class="btn btn-pink">图片</button>
                <button type="button" class="btn btn-pink">文章</button>
                <button type="button" class="btn btn-pink">收藏</button>

            </div>

        </div>


            @if ($posts->count() > 0)

                @foreach ($posts as $post)
                    <div class="part bubble-loop">

                        <div class="user-info row-box">
                            <div class="avatar">
                                <a href="{{route('user.show',$post->user)}}" target="_blank">
                                    <img src="http://qingqu.test/uploads/images/posts/202003/03/ooxx_1583234915_kdaTMz.jpeg" alt="{{$post->user->name}}的个人中心">
                                </a>
                            </div>
                            <div class="name-time col-box">
                                <div class="name-zone">
                            <span><a href="{{ route('user.show', $post->user )}}" target="_blank">
                                    {{$post->user->name}}
                                </a></span>
                                    <span class="level badge badge-warning">Level.22</span>
                                    <span class="vip badge badge-danger">VIP会员</span>
                                    <span class="plus badge badge-dark">官方</span>

                                </div>
                                <div class="time-zone">
                                    <a href="{{route('post.show',[$post->category->slug,$post])}}" target="_blank" title="{{$post->title}}">
                                <span>
                                    {{ $post->created_at->diffForHumans() }}
                                </span>
                                    </a>
                                </div>

                            </div>

                        </div>
                        @if($post->type == 'bubble')

                            @else
                        <div class="bubble-title">
                            {{$post->title}}
                        </div>
                        @endif
                        <div class="bubble-content">
                            {{--<a href="{{ route('post.show',[$category->slug,$post]) }}">--}}
                            {!! $post->content !!}

                        </div>


                        <div class="row-box for-bubble-del">
                            <div>
                                {{--<div class="bubble-info">--}}
                                {{--<span>666 shoucang/dianzan</span>--}}
                                {{--<span>999 views</span>--}}
                                {{--<span>888 comments98798798798798798798</span>--}}
                                {{--</div>--}}

                                @php
                                    $tags = explode(',',$post->tags);
                                @endphp

                                <div class="bubble-topics">
                                    @if($post->tags != NULL)
                                        @foreach($tags as $tag)
                                            <a href="">
                                                <span class="tag-before">#</span>
                                                <span>{{$tag}}</span>
                                            </a>

                                        @endforeach
                                    @endif

                                </div>
                            </div>
                        </div>


                    </div>

                @endforeach


                <div class="mt-5">
                    {!! $posts->render() !!}
                </div>
            @else
                <p>没有数据！</p>
            @endif

        </div>











    @include('sidebar._user-center-sidebar')





@stop

