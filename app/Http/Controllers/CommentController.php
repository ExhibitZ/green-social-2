<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create(string $postId)
    {
        return view('comments.create', compact('postId'));
    }

    public function store(Request $request, string $postId)
    {
        $request->validate([
            'message' => 'required | string | max:2048', 
        ]);

        $comment = new Comment();
        $comment->message = $request->message;

        $post = Post::find($postId);
        $post->comments()->save($comment);

        return redirect()->route('posts.show', $postId)->with('success', 'Post created successfully.');
    }

    public function edit(string $postId, string $commentId)
    {
        $comment = Comment::find($commentId);

        return view('comments.edit', compact('postId', 'comment'));
    }

    public function update(Request $request, string $postId, string $commentId)
    {
        $request->validate([
            'message' => 'required | string | max:2048', 
        ]);

        $comment = Comment::find($commentId);
        $comment->message = $request->message;

        $post = Post::find($postId);
        $post->comments()->save($comment);

        return redirect()->route('posts.show', $postId)->with('success','Comment Updated successfully.');
    }
}
