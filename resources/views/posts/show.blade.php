@extends('layouts.master')

@section('title', 'The post')

@section('content')
    <div class="container">
        <p>{{ $slug }}</p>
    </div>
@endsection
