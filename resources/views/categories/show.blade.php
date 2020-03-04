@extends('layouts.default')

@section('title',$category->name)

@if($category->slug == 'bubble')
    @section('css')
        <link rel="stylesheet" type="text/css" href="{{ asset('css/simditor.css') }}">
        <link href="{{asset('css/jquery-ui.css')}}" rel="stylesheet">
        <link href="{{asset('css/jquery.tagsinput-revisited.min.css')}}" rel="stylesheet">
    @stop
@endif

@section('content')


    <div class="col-lg-8 left">


        @switch($category->type)
            @case('image')
                @include('categories._image')
            @break

            @case('bubble')
                @include('categories._bubble')
            @break

            @default
                 @include('categories._default')
        @endswitch

    </div>

    @switch($category->type)
        @case('image')
        @include('sidebar._home-sidebar')
        @break

        @default
        @include('sidebar._home-sidebar')
    @endswitch



@stop

@if($category->slug == 'bubble')
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
@endif