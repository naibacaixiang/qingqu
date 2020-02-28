<div class="part category">
    {{$category->name}}
</div>

<div class="part post-loop">

    @if ($posts->count() > 0)
        @foreach($posts as $post)

            <div><a href="{{route('post.show',[$post->category->slug,$post->id])}}">{{$post->title}}</a></div>

            <div>{{$post->content}}</div>

            <div><a href="{{route('user.show',$post->user->id)}}">{{$post->user->name}}</a></div>



        @endforeach

    @else
        meiyou dongxi

    @endif

</div>