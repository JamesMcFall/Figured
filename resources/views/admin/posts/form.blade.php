@extends('layouts.app')

@section("content")


<div class="row">
    <div class="col-sm-12">

        <h1>{{ Request::segment(3) == "new" ? "Create New " : "Edit " }}Blog Post</h1>

    </div>
</div>

<div class="row">
    <div class="col-md-8">

        @if ($errors->any())
        <div class="alert alert-danger">
            Please fix the below errors:
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif


        <form method="post" action="/admin/posts/process" id="postForm">

            <input name="_token" type="hidden" value="{{ csrf_token() }}">
            <input type="hidden" name="postId" value="{{ $post->id ?? "" }}" />


            {{-- Blog Post Title --}}
            <div class="form-group">
                <label for="title">Title *</label>
                <input type="text" name="title" class="form-control"
                       autocomplete="off"
                       placeholder="Title"
                       value="{{ $post->title ?? "" }}"
                       />
            </div>

            {{-- Post URL Slug --}}
            <div class="form-group">
                <label for="slug">Slug *</label>
                <input type="text" name="slug" class="form-control"
                       autocomplete="off"
                       placeholder="blog-slug-here"
                       value="{{ $post->slug ?? "" }}"
                       />
            </div>

            {{-- Post Intro --}}
            <div class="form-group">
                <label for="intro">Intro</label>
                <span class="fieldInstructions">
                    A short introduction to be used on the main blog listing page. If
                    nothing is supplied a subset of the body content will be displayed.
                </span>
                <textarea name="intro" class="form-control">{{ $post->intro ?? "" }}</textarea>
            </div>

            {{-- Post Body Content --}}
            <div class="form-group">
                <label for="body">Body *</label>
                <textarea name="body" class="form-control ckeditor">{{ $post->body ?? "" }}</textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Post</button>
            </div>

        </form>
    </div>
    <div class="col-md-4">
        <br />
        <h5>Created At:</h5>
        {{ $post->created ?? "N/A" }}
        <br />
        <br />
        <h5>Last Updated:</h5>
        {{ $post->lastUpdated ?? "N/A" }}
    </div>

</div>
@stop
