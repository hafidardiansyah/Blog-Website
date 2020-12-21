@extends('layouts.app', ['title' => 'Create post'])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5 mb-2">
                <h3 class="mb-2">Cover Image</h3>
                <img src="https://dummyimage.com/900x700/000/fff" alt="Default Image" class="img-thumbnail img-preview">
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">New post</div>
                    <div class="card-body">
                        <form action="/posts/save" method="POST" enctype="multipart/form-data" class="needs-validation">
                            @csrf
                            @include('posts.partials.form-control', ['submit' => 'Create'])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
