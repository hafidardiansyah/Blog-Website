@extends('layouts.app', ['title' => 'List post', 'keyword' => ''])

@section('content')
    <div class="container">
        <div class="card-columns">
            @forelse ($posts as $post)
                <div class="card mb-4">
                    @if ($post->thumbnail)
                        <a href="/posts/{{ $post->slug }}">
                            <img src="{{ asset($post->takeImage()) }}" class="card-img-top" height="200">
                        </a>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ Str::limit($post->body, 80) }}</p>
                        <a href="/posts/{{ $post->slug }}" class="btn btn-primary">Detail</a>
                    </div>
                </div>
            @empty
                <p class="text-info">
                    Ther's no post.
                </p>
            @endforelse
        </div>
        {{ $posts->links() }}
    </div>
@endsection
