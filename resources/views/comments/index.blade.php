@extends('layout')

@section('content')
<div class="container">
    <h2>All Comments</h2>

    <a href="{{ route('comments.create') }}" class="btn btn-primary mb-3">Add New Comment</a>

    @if($comments->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Comment</th>
                    <th>Post Title</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($comments as $comment)
                <tr>
                    <td>{{ $comment->id }}</td>
                    <td>{{ Str::limit($comment->comment, 50) }}</td>
                    <td>{{ $comment->post->title ?? 'No Post' }}</td>
                    <td>
                        <a href="{{ route('comments.show', $comment->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No comments found.</p>
    @endif
</div>
@endsection
