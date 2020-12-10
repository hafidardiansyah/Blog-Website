@extends('layouts.master', ['title' => 'Edit post'])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Update post: {{ $post->title }}</div>
                    <div class="card-body">
                        <form action="/posts/{{ $post->slug }}/update" method="POST">
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
