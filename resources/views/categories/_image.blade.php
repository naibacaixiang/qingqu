<div class="part category-image">


    <h2>{{$category->name}}</h2>
    <p>{{$category->discription}}</p>

<div class="row-box category-image">
    @if ($posts->count() > 0)
        @foreach($posts as $post)

            <div class="category-image-loop">

                <div class="post-cover">
                    <a href="{{route('post.show',[$post->category->slug,$post->id])}}">
                        <img src="http://qingqu.test/uploads/images/20200228/1582925839.jpg" alt="{{$post->title}}">
                    </a>
                </div>
                <div class="post-title">
                    <a href="{{route('post.show',[$post->category->slug,$post->id])}}">
                        <h3>{{$post->title}}</h3>
                    </a>
                </div>


            </div>

        @endforeach
</div>
    @else
        <h1>很抱歉，该分类下还没有文章。</h1>

    @endif

    <div class="post-pagination center-block">{!! $posts->render() !!}</div>
</div>