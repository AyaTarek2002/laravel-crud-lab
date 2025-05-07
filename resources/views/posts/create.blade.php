@extends('layout')

@section('section1')

<form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" class="form-control" name="title" value="{{ old('title') }}">
        @error('title') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <input type="text" class="form-control" name="description" value="{{ old('description') }}">
        @error('description') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Image</label>
        <input type="file" class="form-control" name="image">
        @error('image') <div class="text-danger">{{ $message }}</div> @enderror
    </div>


    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
