<div class="part widget widget-gift">
    <div class="title">分类</div>
    <div class="content">

        <ul class="widget-body list-group">
            @foreach($categories as $category)

                    <a href="{{ route('category.show',$category->slug) }}"
                       class="list-group-item">
                        {{ $category->name }}
                        <span class="badge">{{ $category->posts_count }}</span>
                    </a>

            @endforeach

        </ul>
    </div>

</div>

