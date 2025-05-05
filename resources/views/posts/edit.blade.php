@extends('layout')

@section('section1')

<form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" class="form-control" name="title" value="{{ $post->title }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <input type="text" class="form-control" name="description" value="{{ $post->description }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Image</label><br>
        <img src="{{ asset('storage/' . $post->image) }}" alt="Current Image" width="100">
        <input type="file" class="form-control mt-2" name="image">
    </div>

    <div class="mb-3">
        <label class="form-label">Comment</label>
        <input type="text" class="form-control" name="comment" value="{{ $post->comment }}">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
