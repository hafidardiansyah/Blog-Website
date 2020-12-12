@extends('layouts.app')

@section('title', 'Detail post')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1 class="text-dark">{{ $post->title }}</h1>

                <div class="d-flex justify-content-between align-items-center">
                    <div class="media align-items-center my-3">
                        <img src="{{ $post->author->gravatar() }}" width="26" class="rounded-circle mr-2">
                        <div class="media-body text-dark">
                            {{ $post->author->name }}
                        </div>
                    </div>

                    <small>
                        <a href="/categories/{{ $post->category->slug }}" class="text-decoration-none text-secondary">
                            {{ $post->category->name }}
                        </a>
                        <span class="text-secondary">
                            &middot;
                            {{ $post->created_at->format('d F, Y') }}
                            &middot;
                        </span>
                        @foreach ($post->tags as $tag)
                            <a href="/tags/{{ $tag->slug }}"
                                class="text-decoration-none text-secondary">{{ $tag->name }}</a>
                        @endforeach
                    </small>
                </div>
                @if ($post->thumbnail)
                    <img src="{{ asset($post->takeImage()) }}" class="card-img-top img2 mb-2 rounded w-100">
                @endif
                <hr>
                <p class="text-dark">{!! nl2br($post->body) !!}</p>
                <div>
                    @can('delete', $post)
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-sm btn-danger text-decoration-none" data-bs-toggle="modal"
                            data-bs-target="#deleteModal">
                            Delete
                        </button>

                        <a href="/posts/{{ $post->slug }}/edit" class="btn btn-sm btn-success">Edit</a>

                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Are you sure you want to delete?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h2>{{ $post->title }}</h2>
                                        <p>{{ $post->body }}</p>
                                        <p class="text-secondary fs-6">Published on {{ $post->created_at->diffForHumans() }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="/posts/{{ $post->slug }}/delete" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endcan
                </div>
            </div>

            <div class="col-md-4">
                <h3 class="text-dark mt-3">More post</h3>
                <hr>
                @foreach ($posts as $post)
                    <div class="card mb-4">
                        <div class="card-body">
                            <small>
                                <a href="/categories/{{ $post->category->slug }}"
                                    class="text-decoration-none text-secondary">
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

                            <div class="align-items-center mt-2">
                                <div class="media align-items-center">
                                    <img src="{{ $post->author->gravatar() }}" width="30" class="rounded-circle mr-2">
                                    <div class="media-body text-dark">
                                        {{ $post->author->name }}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
