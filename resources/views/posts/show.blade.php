@extends('layouts.app')

@section('content')

<div class="container">
  <div class="col-md-10 offset-md-1">
    <div class="card ">
      <div class="card-header">
        <h1>Post / Show #{{ $post->id }}</h1>
      </div>

      <div class="card-body">
        <div class="card-block bg-light">
          <div class="row">
            <div class="col-md-6">
              <a class="btn btn-link" href="{{ route('posts.index') }}"><- Back</a>
            </div>
            <div class="col-md-6">
              <a class="btn btn-sm btn-warning float-right mt-1" href="{{ route('posts.edit', $post->id) }}">
                Edit
              </a>
            </div>
          </div>
        </div>
        <br>

        <label>Title</label>
<p>
	{{ $post->title }}
</p> <label>Content</label>
<p>
	{{ $post->content }}
</p> <label>User_id</label>
<p>
	{{ $post->user_id }}
</p> <label>Category_id</label>
<p>
	{{ $post->category_id }}
</p> <label>Tags</label>
<p>
	{{ $post->tags }}
</p> <label>Reply_count</label>
<p>
	{{ $post->reply_count }}
</p> <label>View_count</label>
<p>
	{{ $post->view_count }}
</p> <label>Gift_count</label>
<p>
	{{ $post->gift_count }}
</p> <label>Status</label>
<p>
	{{ $post->status }}
</p> <label>Download_link</label>
<p>
	{{ $post->download_link }}
</p> <label>Excerpt</label>
<p>
	{{ $post->excerpt }}
</p>
      </div>
    </div>
  </div>
</div>

@endsection
