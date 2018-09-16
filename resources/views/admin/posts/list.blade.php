@extends('layouts.app')

@section("content")

<div class="row">
    <div class="col-sm-12">

        <h1>Manage Posts</h1>

    </div>
</div>

<div class="row">
    <div class="col-sm-12">

        @if (Session::has('message'))
        <div class="alert alert-success" role="alert">
            {!! session('message') !!}
        </div>
        @endif

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Post Date</th>
                    <th scope="col" colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->slug }}</td>
                    <td>{{ \Carbon\Carbon::parse($post->postDate)->format('d M Y')}}</td>
                    <td>
                        <a href="/post/{{ $post->slug }}" title="View">
                            <i class="fas fa-link"></i>
                        </a>
                    </td>
                    <td>
                        <a href="/admin/posts/{{ $post->id }}/edit" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                    <td>
                        <a href="/admin/posts/{{ $post->id }}/delete" data-title="{{ $post->title }}" role="deletePost" title="Delete">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach



            </tbody>
        </table>
    </div>
</div>
@stop
