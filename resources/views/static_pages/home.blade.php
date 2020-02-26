@extends('layouts.default')

@section('content')


    <div class="col-lg-8 left">

        @if (Auth::check())

            @if ($feed_items->count() > 0)


                    @foreach ($feed_items as $bubble)
                    <div class="part bubble-loop">

                        <div class="user-info row-box">
                            <div class="avatar">
                                <img src="https://iph.href.lu/48x48" alt="">
                            </div>
                            <div class="name-time col-box">
                                <div class="name-zone">
                                    <span><a href="{{ route('users.show', $bubble->user->id )}}">{{$bubble->user->name}}</a></span>
                                    <span>Level.22</span>
                                    <span>VIP会员</span>
                                    <span>官方</span>


                                </div>
                                <div class="time-zone">
                                    <span>{{ $bubble->created_at->diffForHumans() }}</span>
                                </div>

                            </div>

                        </div>
                        <div class="bubble-content">
                            {{ $bubble->content }}
                        </div>


                        <div class="row-box for-bubble-del">
                        <div>
                            <div class="bubble-info">


                            <span>666 shoucang/dianzan</span>
                            <span>999 views</span>
                            <span>888 comments98798798798798798798</span>


                            </div>

                            <div class="bubble-topics">


                                <span>#<a href="">春天</a></span>
                                <span>#<a href="">夏填天</a></span>
                                <span>#<a href="">春天</a></span>
                                <span>#<a href="">winter</a></span>

                            </div>

                        </div>

                        @can('destroy', $bubble)
                            <div>

                                <form action="{{ route('bubbles.destroy', $bubble->id) }}"  method="POST" onsubmit="return confirm('您确定要删除本条微博吗？');">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-sm btn-danger">删除</button>
                                    <button type="submit" class="btn btn-sm btn-danger">删除</button>
                                </form>

                            </div>

                        @endcan
                        </div>

                    </div>

                    @endforeach


                <div class="mt-5">
                    {!! $feed_items->render() !!}
                </div>
            @else
                <p>没有数据！</p>
            @endif



            {{--@if ($feed_items->count() > 0)--}}
                {{--<ul class="list-unstyled">--}}
                    {{--@foreach ($feed_items as $bubble)--}}
                        {{--@include('bubbles._bubble',  ['user' => $bubble->user])--}}
                    {{--@endforeach--}}
                {{--</ul>--}}
                {{--<div class="mt-5">--}}
                    {{--{!! $feed_items->render() !!}--}}
                {{--</div>--}}
            {{--@else--}}
                {{--<p>没有数据！</p>--}}
            {{--@endif--}}


        @else
        kjkjkj

            @endif



    </div>







    @include('sidebar._home-sidebar')





@stop




