@extends('layouts.app')

@section('content')
<div class="container">
  <div class="col-md-10 offset-md-1">
    <div class="card ">
      <div class="card-header">
        <h1>
          Post
          <a class="btn btn-success float-xs-right" href="{{ route('posts.create') }}">Create</a>
        </h1>
      </div>

      <div class="card-body">
        @if($posts->count())
          <table class="table table-sm table-striped">
            <thead>
              <tr>
                <th class="text-xs-center">#</th>
                <th>Title</th> <th>Content</th> <th>User_id</th> <th>Category_id</th> <th>Tags</th> <th>Reply_count</th> <th>View_count</th> <th>Gift_count</th> <th>Status</th> <th>Download_link</th> <th>Excerpt</th>
                <th class="text-xs-right">OPTIONS</th>
              </tr>
            </thead>

            <tbody>
              @foreach($posts as $post)
              <tr>
                <td class="text-xs-center"><strong>{{$post->id}}</strong></td>

                <td>{{$post->title}}</td> <td>{{$post->content}}</td> <td>{{$post->user_id}}</td> <td>{{$post->category_id}}</td> <td>{{$post->tags}}</td> <td>{{$post->reply_count}}</td> <td>{{$post->view_count}}</td> <td>{{$post->gift_count}}</td> <td>{{$post->status}}</td> <td>{{$post->download_link}}</td> <td>{{$post->excerpt}}</td>

                <td class="text-xs-right">
                  <a class="btn btn-sm btn-primary" href="{{ route('posts.show', $post->id) }}">
                    V
                  </a>

                  <a class="btn btn-sm btn-warning" href="{{ route('posts.edit', $post->id) }}">
                    E
                  </a>

                  <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="DELETE">

                    <button type="submit" class="btn btn-sm btn-danger">D </button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {!! $posts->render() !!}
        @else
          <h3 class="text-xs-center alert alert-info">Empty!</h3>
        @endif
      </div>
    </div>
  </div>
</div>

@endsection
