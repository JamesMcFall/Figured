@extends('layouts.app')

@section("title")
{{ config('app.name') }}
@stop

@section("content")
<div class="row">
    <div class="col-sm-12">

        <h1>{{ config('app.name') }}</h1>

        @foreach ($posts as $post)
        <div class="card blogPost">
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">Post date: {{ \Carbon\Carbon::parse($post->postDate)->format('d M Y')}}</h6>
                <p class="card-text">{{ $post->intro }}</p>

                <a class="card-link" href="/post/{{ $post->slug }}" />
                View <i class="fas fa-link"></i>
                </a>
            </div>
        </div>
        @endforeach


        {{-- Auto generate pagination --}}
        {{ $posts->links() }}
    </div>
</div>
@stop
