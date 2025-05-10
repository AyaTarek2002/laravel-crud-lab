@extends('layout')

@section('pagetitle', $post->title)
@section('title', $post->title)
@section('sub-title', 'Post Details')

@section('section1')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Post Card -->
            <div class="card shadow-sm mb-5">
                @if($post->image)
                    <div class="post-image-wrapper" style="background: #f8f9fa; display: flex; justify-content: center; align-items: center; max-height: 80vh; overflow: hidden;">
                        <img src="{{ asset('storage/' . $post->image) }}" 
                             class="img-fluid" 
                             alt="Post Image"
                             style="max-width: 100%; max-height: 80vh; width: auto; height: auto; object-fit: contain;">
                    </div>
                @else
                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 300px;">
                        <i class="fas fa-image fa-5x text-muted"></i>
                    </div>
                @endif
                
                <div class="card-body">
                    <h2 class="card-title mb-3">{{ $post->title }}</h2>
                    <div class="card-text mb-4">
                        {!! nl2br(e($post->description)) !!}
                    </div>
                    
                    
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Posts
                        </a>
                        <div>
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-outline-primary">
                                <i class="fas fa-edit me-2"></i>Edit Post
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer bg-transparent text-muted d-flex justify-content-between">
                    <small><i class="far fa-calendar-plus me-1"></i> {{ $post->created_at->format('M d, Y H:i') }}</small>
                    <p>Created by: {{ $post->user->name }}</p>


                    

                   
                </div>
            </div>

            <!-- Comments Section -->
            <div class="mb-5">
                <h4 class="mb-4 pb-2 border-bottom">
                    <i class="far fa-comments me-2"></i>Comments 
                    <span class="badge bg-primary rounded-pill ms-2">{{ $post->comments->count() }}</span>
                </h4>
                
                @forelse($post->comments->where('parent_id', null) as $comment)
    <div class="card mb-3 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <div>
                    <span class="text-muted small">Comment by {{ $comment->user->name }}</span> 
                </div>
                <div class="text-muted small">
                    {{ $comment->created_at->format('M d, Y H:i') }}
                </div>
            </div>
            
            <p class="card-text mb-3">{!! nl2br(e($comment->comment)) !!}</p>
            
            <!-- Reply Button -->
            <button class="btn btn-sm btn-outline-secondary mb-3 reply-button" 
                    data-comment-id="{{ $comment->id }}">
                <i class="fas fa-reply me-1"></i>Reply
            </button>
            
            <!-- Reply Form (Hidden by default) -->
            <div class="reply-form mb-3" id="reply-form-{{ $comment->id }}" style="display: none;">
                <form action="{{ route('comments.reply', $comment->id) }}" method="POST">
                    @csrf
                    <div class="mb-2">
                        <textarea name="comment" class="form-control" rows="2" 
                                  placeholder="Write your reply..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">
                        <i class="far fa-paper-plane me-1"></i>Submit Reply
                    </button>
                </form>
            </div>
            
            <!-- Replies Section -->
            @if($comment->replies->count() > 0)
                <div class="replies ms-4 mt-3 border-start ps-3">
                    @foreach($comment->replies as $reply)
                        <div class="card mb-2 shadow-sm">
                            <div class="card-body py-2">
                                <div class="d-flex justify-content-between align-items-start mb-1">
                                    <div>
                                        <span class="text-muted small">Reply by {{ $reply->user->name }}</span>
                                    </div>
                                    <div class="text-muted small">
                                        {{ $reply->created_at->format('M d, Y H:i') }}
                                    </div>
                                </div>
                                
                                <p class="card-text mb-2 small">{!! nl2br(e($reply->comment)) !!}</p>
                                
                                <div class="d-flex justify-content-end gap-2">
                                    @can('update-comment', $reply)
                                        <a href="{{ route('comments.edit', $reply->id) }}" 
                                           class="btn btn-sm btn-outline-warning">
                                            <i class="fas fa-edit me-1"></i>Edit
                                        </a>
                                    @endcan
                                    
                                    @can('delete-comment', $reply)
                                        <form action="{{ route('comments.destroy', $reply->id) }}" method="POST" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash me-1"></i>Delete
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            
            <div class="d-flex justify-content-end gap-2">
                @can('update-comment', $comment)
                    <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-sm btn-outline-warning">
                        <i class="fas fa-edit me-1"></i>Edit
                    </a>
                @endcan
                
                @can('delete-comment', $comment)
                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">
                            <i class="fas fa-trash me-1"></i>Delete
                        </button>
                    </form>
                @endcan
            </div>
        </div>
    </div>
@empty
    <div class="alert alert-info">
        <i class="fas fa-info-circle me-2"></i>No comments yet. Be the first to comment!
    </div>
@endforelse

            </div>

            <!-- Add Comment Form -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-4">
                        <i class="far fa-plus-square me-2"></i>Add a Comment
                    </h4>
                    
                    <form action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <textarea name="comment" id="comment" class="form-control" rows="4" 
                                placeholder="Write your comment here..." required>{{ old('comment') }}</textarea>
                            @error('comment')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <button type="submit" class="btn btn-primary">
                            <i class="far fa-paper-plane me-2"></i>Submit Comment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .post-image-wrapper {
        position: relative;
        min-height: 200px;
    }
    
    .post-image-wrapper img {
        display: block;
        margin: 0 auto;
    }
    
    @media (max-width: 768px) {
        .post-image-wrapper {
            max-height: 60vh !important;
        }
    }
</style>

<script>
        document.addEventListener('DOMContentLoaded', function() {
       
        const deleteForms = document.querySelectorAll('.delete-form');
        
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });

   
    document.addEventListener('DOMContentLoaded', function() {
        // Handle reply button clicks
        document.querySelectorAll('.reply-button').forEach(button => {
            button.addEventListener('click', function() {
                const commentId = this.getAttribute('data-comment-id');
                const replyForm = document.getElementById(`reply-form-${commentId}`);
                
                if (replyForm.style.display === 'none') {
                    replyForm.style.display = 'block';
                    this.innerHTML = '<i class="fas fa-times me-1"></i>Cancel';
                } else {
                    replyForm.style.display = 'none';
                    this.innerHTML = '<i class="fas fa-reply me-1"></i>Reply';
                }
            });
        });
        
        // Handle delete confirmation
        const deleteForms = document.querySelectorAll('.delete-form');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });

</script>
@endsection