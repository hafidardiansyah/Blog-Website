@extends('layouts.app', ['title' => 'List post'])

@section('content')
    <div class="container">
        <div>
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
            {{-- <div>
                @if (Auth::check())
                    <a href="/posts/create" class="btn btn-primary">New post</a>
                    @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Login to create new post</a>
                @endif
            </div> --}}
        </div>

        <div class="row">
            <div class="col-md-8">
                @forelse ($posts as $post)
                    <div class="card mb-4">
                        @if ($post->thumbnail)
                            <a href="/posts/{{ $post->slug }}">
                                <img src="{{ asset($post->takeImage()) }}" class="card-img-top img">
                            </a>
                        @endif
                        <div class="card-body">
                            <small>
                                <a href="/categories/{{ $post->category->slug }}" class="text-decoration-none text-secondary">
                                    {{ $post->category->name }}
                                </a>
                                <span class="text-secondary">-</span>
                                @foreach ($post->tags as $tag)
                                    <a href="/tags/{{ $tag->slug }}"
                                        class="text-decoration-none text-secondary">{{ $tag->name }}</a>
                                @endforeach
                            </small>

                            <h4 class="card-title">
                                <a href="/posts/{{ $post->slug }}" class="text-decoration-none text-dark">
                                    {{ $post->title }}
                                </a>
                            </h4>

                            <div class="text-secondary my-3">{{ Str::limit($post->body, 190) }}</div>

                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <div class="media align-items-center">
                                    <img src="{{ $post->author->gravatar() }}" width="30" class="rounded-circle mr-2">
                                    <div class="media-body text-dark">
                                        {{ $post->author->name }}
                                    </div>
                                </div>
                                <div class="text-secondary">
                                    <small>
                                        Published on {{ $post->created_at->diffForHumans() }}
                                    </small>
                                </div>
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
            {{-- <div class="col-md-4">
                <ul class="list-group">
                    @foreach ($categories as $category)
                        <li class="list-group-item"><a
                                href="/categories/{{ $post->category->slug }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div> --}}
        </div>

        {{ $posts->links() }}

    </div>
@endsection
