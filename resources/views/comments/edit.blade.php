@extends('layout')

@section('section2')
<div class="container">
    <h2>Edit Comment</h2>

    <form action="{{ route('comments.update', $comment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="comment" class="form-label">Comment</label>
            <textarea name="comment" id="comment" class="form-control" required>{{ old('comment', $comment->comment) }}</textarea>
            @error('comment')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Comment</button>
    </form>
</div>
@endsection
