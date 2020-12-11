@extends('layouts.app', ['title' => 'List post'])

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between">
            <div>
                @isset($category)
                    <h4>Category: {{ $category->name }}</h4>
                @endisset

                @isset($tag)
                    <h4>Tag: {{ $tag->name }}</h4>
                @endisset

                @if (!isset($tag) && !isset($category))
                    <h4>All posts</h4>
                @endif
                <hr>
            </div>
            <div>
                @if (Auth::check())
                    <a href="/posts/create" class="btn btn-primary">New post</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Login to create new post</a>
                @endif
            </div>
        </div>

        <div class="row">
            @forelse ($posts as $post)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            {{ $post->title }}
                        </div>
                        <img src="{{ asset($post->takeImage()) }}" class="card-img-top img">
                        <div class="card-body">
                            <div>
                                {{ Str::limit($post->body, 100) }}
                            </div>

                            <a href="/posts/{{ $post->slug }}" class="text-decoration-none">Read more</a>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            Published on {{ $post->created_at->diffForHumans() }}
                            @can('update', $post)
                                <a href="/posts/{{ $post->slug }}/edit" class="btn btn-sm btn-success">Edit</a>
                            @endcan
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
