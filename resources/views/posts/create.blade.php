@extends('layouts.default')

@section('title','发表文章')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/simditor.css') }}">
    <link href="{{asset('css/jquery-ui.css')}}" rel="stylesheet">
    <link href="{{asset('css/jquery.tagsinput-revisited.min.css')}}" rel="stylesheet">
@stop

@section('content')



    <div class="col-lg-8 left">

        <div class="card">
            <div class="card-header">
                发表文章
            </div>
            <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>


                <form action="{{route('post.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">标题</label>
                        <input type="text" class="form-control" name="title" id="" aria-describedby="" placeholder="请输入标题">

                    </div>


                    <div class="form-group">
                        <label for="content">正文</label>

                        <textarea name="content" class="form-control" id="editor" rows="6" placeholder=""
                                  required>{{ old('content', $post->content ) }}
                        </textarea>

                    </div>


                    <div class="form-group">
                        <label for="tag">话题</label>
                        <input id="tags-input" name="tags" type="text" value="">

                        <small id="" class="form-text text-muted">为了让更多的人看到文章，请标记几个合适的话题</small>
                    </div>




                    <button type="submit" class="btn btn-dark">提交</button>
                </form>
            </div>
        </div>



    </div>




        @include('sidebar._home-sidebar')



@stop


@section('js')
    <script type="text/javascript" src="{{ asset('js/module.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/hotkeys.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/uploader.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/simditor.js') }}"></script>

    <script type="text/javascript" src="{{asset('js/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.tagsinput-revisited.min.js')}}"></script>

    <script>
        $(document).ready(function() {
            var editor = new Simditor({
                textarea: $('#editor'),
                upload: {
                    url: '{{ route('upload.image') }}',
                    params: {
                        _token: '{{ csrf_token() }}'
                    },
                    fileKey: 'upload_file',
                    connectionCount: 99,
                    leaveConfirm: '文件上传中，关闭此页面将取消上传。'
                },
                pasteImage: true,
            });
        });
    </script>
    <script>$('#tags-input').tagsInput();</script>
@stop













