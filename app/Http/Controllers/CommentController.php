<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return view('comments.index', compact('comments'));

      
    }

    public function create()
    {
       
        return view('comments.create');

    }

    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string',
            'post_id' => 'required|exists:posts,id',
        ]);

        Comment::create($request->all());

        return redirect()->route('posts.show', ['id' => $request->post_id])->with('success', 'Comment added successfully');
    }

    public function show(Comment $comment)
    {
        return view('comments.show', compact('comment'));
    }

    // public function edit(Comment $comment)
    // {
       
    //     return view('comments.edit', compact('comment'));
    // }


    // public function update(Request $request, Comment $comment)
    // {
    //     $request->validate([
    //         'comment' => 'required|string',
    //         'post_id' => 'required|exists:posts,id',
    //     ]);

    //     $comment->update($request->all());

    //     return to_route('comments.index');
    // }


    // public function destroy(Comment $comment)
    // {
    //     $comment->delete();
    //     return to_route('comments.index');
    // }


    public function edit($id)
    {
        $comment = Comment::findOrFail($id);

        // dd($comment);
        return view('comments.edit', compact('comment'));
    }

  
    public function update(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $comment = Comment::findOrFail($id);
        $comment->update([
            'comment' => $request->input('comment'),
        ]);

        return redirect()->route('posts.show', $comment->post_id)->with('success', 'Comment updated successfully');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $postId = $comment->post_id;
        $comment->delete();

        return redirect()->route('posts.show', $postId)->with('success', 'Comment deleted successfully');
    }
}

