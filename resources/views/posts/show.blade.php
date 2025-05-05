@extends('layout')

@section('pagetitle', $post->title)
@section('title', $post->title)
@section('sub-title', 'Post Details')

@section('section1')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="Post Image">
            @else
            <div class="card-img-top bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 300px;">
                <i class="fas fa-image fa-5x"></i>
            </div>
            @endif
            <div class="card-body">
                <h3 class="card-title">{{ $post->title }}</h3>
                <p class="card-text">{{ $post->description }}</p>
                @if($post->comment)
                <div class="alert alert-info">
                    <h5>Comment:</h5>
                    <p>{{ $post->comment }}</p>
                </div>
                @endif
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('posts.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left"></i> Back to Posts
                    </a>
                    <div>
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted d-flex justify-content-between">
                <small>Created: {{ $post->created_at->format('M d, Y H:i') }}</small>
                <small>Updated: {{ $post->updated_at->format('M d, Y H:i') }}</small>
            </div>
        </div>
    </div>
</div>
@endsection