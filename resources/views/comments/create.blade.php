@extends('layout')

@section('content')
<div class="container">
    <h2>Add New Comment</h2>

    <form action="{{ route('comments.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="comment" class="form-label">Comment</label>
            <textarea name="comment" id="comment" class="form-control" required>{{ old('comment') }}</textarea>
            @error('comment')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="post_id" class="form-label">Select Post</label>
            <select name="post_id" id="post_id" class="form-control" required>
                <option value="">-- Select a post --</option>
                @foreach($posts as $post)
                    <option value="{{ $post->id }}" {{ old('post_id') == $post->id ? 'selected' : '' }}>
                        {{ $post->title }}
                    </option>
                @endforeach
            </select>
            @error('post_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Add Comment</button>
    </form>
</div>
@endsection
