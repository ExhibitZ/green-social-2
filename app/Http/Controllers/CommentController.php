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
}
