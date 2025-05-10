<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
        $validated = $request->validate([
            'comment' => 'required|string',
            'post_id' => 'required|exists:posts,id',
            'parent_id' => 'nullable|exists:comments,id',
        ]);
    
        $comment = new Comment();
        $comment->comment = $validated['comment'];
        $comment->post_id = $validated['post_id'];
     
        $comment->user_id = auth()->id(); 
        $comment->save();

        if (isset($validated['parent_id'])) {
            $comment->parent_id = $validated['parent_id'];
        }
    
        return redirect()->route('posts.show', $validated['post_id']);
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
        if (Gate::denies('update-comment', $comment)) {
            abort(403, 'You do not have permission to edit this comment.');
        }
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
        if (Gate::denies('delete-comment', $comment)) {
            abort(403, 'You do not have permission to delete this comment.');
        }
        $postId = $comment->post_id;
        $comment->delete();

        return redirect()->route('posts.show', $postId)->with('success', 'Comment deleted successfully');
    }

    public function reply(Request $request, Comment $comment)
    {
        $request->validate([
            'comment' => 'required|string|max:1000'
        ]);
    
        $reply = new Comment([
            'comment' => $request->comment,
            'parent_id' => $comment->id
        ]);
    
        $reply->user_id = auth()->id();
        $reply->post_id = $comment->post_id;
        $reply->save();
    
        return back()->with('success', 'Reply added successfully!');
    }


}

