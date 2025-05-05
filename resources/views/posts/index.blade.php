@extends('layout')

@section('section1')
<a class="btn btn-info" href="{{ route('posts.create') }}"> Create New Post </a>

<div class="row">
    @foreach ($posts as $post)
        <div class="col-md-4 mb-4">
            <div class="card" style="width: 100%;">
                <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="Post Image" width="80" height="100">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ $post->description }}</p>
                    <p class="card-text">{{ $post->comment }}</p>

                    <a class="btn btn-primary" href="{{ route('posts.show', $post->id) }}"> Show </a>
                    <a class="btn btn-warning" href="{{ route('posts.edit', $post->id) }}"> Edit </a>

                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="mt-2">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger" type="submit"> Delete </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
