@extends('layouts.default')

@section('title',$category->name)

@section('content')


    <div class="col-lg-8 left">


        @switch($category->type)
            @case('image')
                @include('categories._image')
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