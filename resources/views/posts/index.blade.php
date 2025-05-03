@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>All Posts</h1>

    <a href="{{ route('posts.create') }}" class="btn btn-success mb-3">Add New Post</a>
    
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td>{{ $post['title'] }}</td>
                <td>{{ $post['description'] }}</td>
                <td>
                    <a href="{{ route('posts.show', $post['id']) }}" class="btn btn-info btn-sm">Show</a>
                    <a href="{{ route('posts.edit', $post['id']) }}" class="btn btn-warning btn-sm">Edit</a>
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $post['id'] }}">Delete</button>
                    
                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal{{ $post['id'] }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this post?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('posts.destroy', $post['id']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection