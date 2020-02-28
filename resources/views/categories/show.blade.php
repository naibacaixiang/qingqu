@extends('layouts.default')

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


    @include('sidebar._home-sidebar')





@stop