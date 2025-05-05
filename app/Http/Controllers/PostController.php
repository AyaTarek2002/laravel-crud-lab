<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{
    function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    function create()
    {
        return view('posts.create');
    }

    function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image' => ['nullable', 'image'], 
            'comment' => ['nullable', 'string'],
        ]);

        $post = new Post();

        $post->title = $validated['title'];
        $post->description = $validated['description'];
        $post->comment = $validated['comment'] ?? null;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $post->image = $path;
        }

        $post->save();

        return to_route('posts.index');
    }

    function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'comment' => ['nullable', 'string'],
        ]);

        $post->title = $validated['title'];
        $post->description = $validated['description'];
        $post->comment = $validated['comment'] ?? null;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $post->image = $path;
        }

        $post->save();

        return to_route('posts.index');
    }

    function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return to_route('posts.index');
    }
}
