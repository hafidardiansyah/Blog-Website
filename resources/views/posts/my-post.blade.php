@extends('layouts.app', ['title' => 'List post'])

@section('content')
    <div class="container">
        <div class="card-columns">
            @foreach ($posts as $post)
                <div class="card mb-4">
                    @if ($post->thumbnail)
                        <a href="/posts/{{ $post->slug }}">
                            <img src="{{ asset($post->takeImage()) }}" class="card-img-top">
                        </a>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ Str::limit($post->body, 80) }}</p>
                        <a href="/posts/{{ $post->slug }}" class="btn btn-primary">Detail</a>
                    </div>
                </div>
            @endforeach
        </div>
        {{-- {{ $posts->links() }} --}}
    </div>
@endsection
