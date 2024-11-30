<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy("created_at", "desc")->paginate(10);

        return view("posts.index", compact("posts"));
    }

    public function show(string $postId)
    {
        $post = Post::find($postId);
        $comments = Comment::where('post_id', $postId)->orderBy("created_at", "desc")->paginate(10);

        return view('posts.show', compact('post', 'comments'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required | string | max:2048', 
        ]);

        $post = new Post();
        $post->message = $request->message;
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function edit(string $postId)
    {
        $post = Post::find($postId);

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, string $postId)
    {
        $request->validate([
            'message' => 'required | string | max:2048', 
        ]);

        $post = Post::find($postId);
        $post->message = $request->message;
        $post->save();

        return redirect()->route('posts.index')->with('success','Post Updated successfully.');
    }

    public function destroy(string $postId)
    {
        Post::find($postId)->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
