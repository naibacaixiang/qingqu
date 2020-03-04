@extends('layouts.default')
@section('title', $title)

@section('content')
    <div class="col-lg-8 left">



        <div class="mini-nav">

            <div class="btn-group" role="group" aria-label="">
                <button type="button" class="btn btn-pink">全部</button>
                <button type="button" class="btn btn-pink">冒泡</button>
                <button type="button" class="btn btn-pink">图片</button>
                <button type="button" class="btn btn-pink">文章</button>
                <button type="button" class="btn btn-pink">收藏</button>
                <button type="button" class="btn btn-pink">粉丝</button>
                <button type="button" class="btn btn-pink">关注</button>
                <button type="button" class="btn btn-pink">文章</button>
                <button type="button" class="btn btn-pink">收藏</button>
                <button type="button" class="btn btn-pink">粉丝</button>


            </div>

        </div>



        <div class="part follow-list">




            <h2 class="text-center title">{{ $title }}</h2>

            <div class="follow-list">
                @foreach ($follow_users as $follow_user)
                    <div class="follow-list-loop row-box">
                        <div class="follow-avatar">
                            <img class="" src="{{ $follow_user->gravatar() }}" alt="{{ $follow_user->name }}" width=64>

                        </div>
                        <div>
                            <div class="follow-name-level-vip">
                            <span class="user-name"><a href="{{ route('user.show', $follow_user )}}" target="_blank">
                                    <strong>{{$follow_user->name}}</strong>
                                </a></span>
                            <span class="level badge badge-warning">Level.22</span>
                            <span class="vip badge badge-danger">VIP会员</span>
                            <span class="plus badge badge-dark">官方</span>
                            </div>
                            <div class="">



                                @if(Auth::check())
                                        @if (Auth::user()->isFollowing($follow_user->id))
                                        <div class="follow">
                                            <form action="{{ route('followers.destroy', $follow_user) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-dark">取消关注</button>
                                            </form>
                                        </div>
                                        @else
                                                <div class="follow">
                                            <form action="{{ route('followers.store', $follow_user) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-pink">关注</button>
                                            </form>
                                                </div>
                                        @endif
                                    @endif





                            </div>
                        </div>

                    </div>


                @endforeach
            </div>

            <div class="">
                {!! $follow_users->render() !!}
            </div>
        </div>

    </div>







    @include('sidebar._user-center-sidebar')





@stop

