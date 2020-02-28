<div class="part category-default">


    <h2>{{$category->name}}</h2>
    <p>{{$category->discription}}</p>


    @if ($posts->count() > 0)
        @foreach($posts as $post)

            <div class="row-box category-default-loop">
                <div class="post-title"><a href="{{route('post.show',[$post->category->slug,$post->id])}}"><h3>{{$post->title}}</h3></a></div>
                <div class="">{{$post->created_at}}</div>

            </div>

        @endforeach

    @else
        <h1>很抱歉，该分类下还没有文章。</h1>

    @endif

        <div class="post-pagination center-block">{!! $posts->render() !!}</div>
</div>

