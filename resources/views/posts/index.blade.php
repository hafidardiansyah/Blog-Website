@extends('layouts.app', ['title' => 'List post'])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h3 class="text-dark">All posts</h3>
                <hr>
                @forelse ($posts as $post)
                    <div class="card mb-4">
                        @if ($post->thumbnail)
                            <a href="/posts/{{ $post->slug }}">
                                <img src="{{ asset($post->takeImage()) }}" class="card-img-top img"
                                    alt="{{ asset($post->takeImage()) }}">
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
                            <h5 class="card-title">
                                <a href="/posts/{{ $post->slug }}" class="text-decoration-none text-dark">
                                    {{ $post->title }}
                                </a>
                            </h5>
                            <div class="text-secondary my-3">{{ Str::limit($post->body, 279) }}</div>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <div class="media align-items-center">
                                    <img src="{{ $post->author->gravatar() }}" width="30" class="rounded-circle mr-2">
                                    <div class="media-body">
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="alert alert-info">
                                Ther's no post.
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="col-md-4">
                <h3 class="text-dark">Categories</h3>
                <hr>
                <ul class="list-group">
                    @foreach ($categories as $category)
                        <li class="list-group-item{{ request()->is('categories/' . $category->slug) ? ' active' : '' }}">
                            <a href="/categories/{{ $category->slug }}"
                                class="text-decoration-none{{ request()->is('categories/' . $category->slug) ? ' text-white' : ' text-dark' }}">{{ $category->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{ $posts->links() }}

    </div>
@endsection
