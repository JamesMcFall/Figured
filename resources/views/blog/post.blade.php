@extends('layouts.app')

@section("title")
    {{ $post->title }} | {{ config('app.name') }}
@stop

@section("content")

    <div class="articleTop">
        <h1>{{ $post->title }}</h1>
        <p>
            Post date: {{ \Carbon\Carbon::parse($post->postDate)->format('d M Y')}}
        </p>
    </div>

    <div class="articleBody">
        {!! $post->body !!}
    </div>

@stop
