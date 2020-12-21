@extends('layouts.app', ['title' => 'Edit post', 'keyword' => ''])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5 mb-2">
                <h3 class="mb-2">Cover Image</h3>
                <img src="{{ asset($post->takeImage()) }}" alt="Default Image" class="img-thumbnail img-preview">
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">Update post: {{ $post->title }}</div>
                    <div class="card-body">
                        <form action="/posts/{{ $post->slug }}/update" method="POST" enctype="multipart/form-data">
                            @method('patch')
                            @csrf
                            @include('posts.partials.form-control')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
