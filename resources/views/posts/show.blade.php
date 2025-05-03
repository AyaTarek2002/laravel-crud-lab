@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">All Posts</a></li>
            <li class="breadcrumb-item active" aria-current="page">Post Details</li>
        </ol>
    </nav>
    
    <div class="card">
        <div class="card-header">
            <h2>Post details</h2>
        </div>
        <div class="card-body">
            <h3>{{ $post['title'] }}</h3>
            <p>{{ $post['description'] }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('posts.index') }}" class="btn btn-primary">Back to All Posts</a>
        </div>
    </div>
</div>
@endsection