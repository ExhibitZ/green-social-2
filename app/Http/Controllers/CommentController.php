<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use File;
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
            'image' => 'image | max:2000'
        ]);

        $comment = new Comment();
        $comment->user_id = auth()->user()->id;
        $comment->post_id = $postId;
        $comment->message = $request->message;
        
        if (!is_null($request->image))
        {
            $file = $request->image;
            $filename = $postId . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('images', $filename, 'public');

            $comment->image = $filename;
        }

        $comment->save();

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
            'image' => 'image | max:2000'
        ]);

        $comment = Comment::find($commentId);
        $comment->message = $request->message;

        if (!is_null($request->image))
        {
            if (!is_null($comment->image))
            {
                File::delete(public_path('storage/images' . $comment->image));
            }
            $file = $request->image;
            $filename = $postId . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('images', $filename, 'public');

            $comment->image = $filename;
        }
        
        $post = Post::find($postId);
        $post->comments()->save($comment);

        return redirect()->route('posts.show', $postId)->with('success','Comment Updated successfully.');
    }

    public function destroy(string $postId, string $commentId)
    {
        $comment = Comment::find($commentId);

        $post = Post::find($postId);

        if (!is_null($comment->image))
        {
            File::delete(public_path('storage/images/' . $comment->image));
        }
        $comment->delete();

        return redirect()->route('posts.show', $postId)->with('success', 'Comment deleted successfully.');
    }
}
