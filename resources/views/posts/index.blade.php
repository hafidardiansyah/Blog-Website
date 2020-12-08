@extends('layouts.master')

@section('title', 'List post')

@section('content')
    <div class="container">

        <div class="d-flex justify-content-between">
            <div>
                <h3>All Post</h3>
                <hr>
            </div>
            <div>
                <a href="posts/create" class="btn btn-primary">New post</a>
            </div>
        </div>

        <div class="row">
            @forelse ($posts as $post)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            {{ $post->title }}
                        </div>
                        <div class="card-body">
                            <div>
                                {{ Str::limit($post->body, 100) }}
                            </div>

                            <a href="posts/{{ $post->slug }}">Read more</a>
                        </div>
                        <div class="card-footer">
                            Published on {{ $post->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-6">
                    <div class="alert alert-info">
                        Ther's no post.
                    </div>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center">
            <div>
                {{ $posts->links() }}
            </div>
        </div>

    </div>
@endsection
