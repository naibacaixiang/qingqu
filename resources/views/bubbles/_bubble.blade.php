<li class="media mt-4 mb-4">
    <a href="{{ route('users.show', $user->id )}}">
        <img src="{{ $user->gravatar() }}" alt="{{ $user->name }}" class="mr-3 gravatar"/>
    </a>
    <div class="media-body">
        <h5 class="mt-0 mb-1">{{ $user->name }} <small> / {{ $bubble->created_at->diffForHumans() }}</small></h5>
        {{ $bubble->content }}
    </div>

    @can('destroy', $bubble)
        <form action="{{ route('bubbles.destroy', $bubble) }}" method="POST" onsubmit="return confirm('您确定要删除本条冒泡吗？');">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-sm btn-danger">删除</button>
        </form>
    @endcan


</li>