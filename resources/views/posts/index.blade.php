@extends('layouts.master')

@section('content')
    <div class="container">
        <h3>All Post</h3>

        <div class="row">

            @foreach ($posts as $post)
                <div class="col-md-4">
                    <div class="card mb-3">
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
            @endforeach

            {{ $posts->links() }}
        </div>
    </div>
@endsection
