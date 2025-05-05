@extends('layout')

@section('pagetitle', 'All Posts')
@section('title', 'Blog Posts')
@section('sub-title', 'Latest updates and news')

@section('section1')
<div class="d-flex justify-content-between mb-4">
    <a class="btn btn-info" href="{{ route('posts.create') }}">
        <i class="fas fa-plus"></i> Create New Post
    </a>
</div>

<div class="row">
    @foreach ($posts as $post)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="Post Image">
                @else
                <div class="card-img-top bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                    <i class="fas fa-image fa-3x"></i>
                </div>
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text flex-grow-1">{{ Str::limit($post->description, 100) }}</p>
                    <div class="mt-auto">
                        <div class="d-flex justify-content-between">
                            <a class="btn btn-sm btn-primary" href="{{ route('posts.show', $post->id) }}">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <a class="btn btn-sm btn-warning" href="{{ route('posts.edit', $post->id) }}">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="delete-form">
    @method('DELETE')
    @csrf
    <button class="btn btn-sm btn-danger" type="submit">
        <i class="fas fa-trash"></i> Delete
    </button>
</form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection