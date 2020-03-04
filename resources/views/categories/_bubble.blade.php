<div class="part category-bubble">

    <form action="{{route('bubble.store')}}" method="POST">
        @csrf
        {{--<div class="form-group">--}}
            {{--<label for="title">标题</label>--}}
            {{--<input type="text" class="form-control" name="title" id="" aria-describedby="" placeholder="请输入标题">--}}

        {{--</div>--}}
        <div class="form-group">
            <label for="tag">话题</label>
            <input id="tags-input" name="tags" type="text" value="">

            <small id="" class="form-text text-muted">想填写多个话题，试试回车嗷~</small>
        </div>

        <div class="form-group">
            <label for="content">正文</label>

            <textarea name="content" class="form-control" id="editor" rows="3" placeholder=""
                      required>
                        </textarea>

        </div>
        <button type="submit" class="btn btn-dark">提交</button>
    </form>
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
                            <span>Level.22</span>
                            <span>VIP会员</span>
                            <span>官方</span>

                        </div>
                        <div class="time-zone">
                            <a href="{{route('post.show',[$category->slug,$post])}}" target="_blank" title="{{$post->title}}">
                                <span>
                                    {{ $post->created_at->diffForHumans() }}
                                </span>
                            </a>
                        </div>

                    </div>

                </div>
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








