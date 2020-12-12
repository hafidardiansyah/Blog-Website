@extends('layouts.app')

@section('title', 'Detail post')

@section('content')
    <div class="container">
        <h3>{{ $post->title }}</h3>

        <div class="text-secondary">
            <a href="/categories/{{ $post->category->slug }}" class="text-decoration-none">
                {{ $post->category->name }}
            </a>

            &middot;
            {{ $post->created_at->format('d F, Y') }}
            &middot;

            @foreach ($post->tags as $tag)
                <a href="/tags/{{ $tag->slug }}" class="text-decoration-none">{{ $tag->name }}</a>
            @endforeach
        </div>

        <div class="media align-items-center my-3">
            <img src="{{ $post->author->gravatar() }}" width="26" class="rounded-circle mr-2">
            <div class="media-body">
                {{ $post->author->name }}
            </div>
        </div>

        <hr>

        <p>{!! nl2br($post->body) !!}</p>

        <div>
            @can('delete', $post)
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-sm btn-danger text-decoration-none" data-bs-toggle="modal"
                    data-bs-target="#deleteModal">
                    Delete
                </button>

                <a href="/posts/{{ $post->slug }}/edit" class="btn btn-sm btn-success">Edit</a>

                <!-- Modal -->
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
        </div>
    </div>
@endsection
