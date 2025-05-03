<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    private function initSession()
    {
        if (!session()->has('posts')) {
            $posts = [
                1 => ['id' => 1, 'title' => 'Post1 title', 'description' => 'post1 description'],
                2 => ['id' => 2, 'title' => 'Post2 title', 'description' => 'post2 description'],
                3 => ['id' => 3, 'title' => 'Post3 title', 'description' => 'post3 description'],
                4 => ['id' => 4, 'title' => 'Post4 title', 'description' => 'post4 description'],
            ];
            session(['posts' => $posts]);
        }
    }

    public function index()
    {
        $this->initSession();
        $posts = session('posts');
        return view('posts.index', compact('posts'));
    }

    public function show($id)
    {
        $this->initSession();
        $posts = session('posts');
        $post = $posts[$id] ?? abort(404);
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->initSession();
        $posts = session('posts');

        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        $newId = max(array_keys($posts)) + 1;
        $newPost = [
            'id' => $newId,
            'title' => $validated['title'],
            'description' => $validated['description'],
        ];

        $posts[$newId] = $newPost;
        session(['posts' => $posts]);

        return redirect()->route('posts.index')->with('success', 'Post added successfully!');
    }

    public function edit($id)
    {
        $this->initSession();
        $posts = session('posts');
        $post = $posts[$id] ?? abort(404);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $this->initSession();
        $posts = session('posts');

        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        if (isset($posts[$id])) {
            $posts[$id]['title'] = $validated['title'];
            $posts[$id]['description'] = $validated['description'];
            session(['posts' => $posts]);
        }

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    public function destroy($id)
    {
        $this->initSession();
        $posts = session('posts');

        if (isset($posts[$id])) {
            unset($posts[$id]);
            session(['posts' => $posts]);
            return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
        }

        return redirect()->route('posts.index')->with('error', 'Post not found!');
    }
}