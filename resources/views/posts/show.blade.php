@extends('layout')

@section('section1')
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card" style="width: 100%;">
            <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="..." width="80" height="100">
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ $post->description }}</p>
                <p class="card-text">{{ $post->comment }}</p>
                <p class="card-text">{{ $post->updated_at }}</p>
                <p class="card-text">{{ $post->created_at }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
