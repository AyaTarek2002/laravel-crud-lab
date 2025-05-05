@extends('layout')

@section('content')
<div class="container">
    <h2>Comment Details</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Comment #{{ $comment->id }}</h5>
            <p class="card-text"><strong>Text:</strong> {{ $comment->comment }}</p>
            <p class="card-text"><strong>Post:</strong> {{ $comment->post->title ?? 'No post found' }}</p>
            <p class="card-text"><strong>Created At:</strong> {{ $comment->created_at->format('Y-m-d H:i') }}</p>

            <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('comments.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
@endsection
