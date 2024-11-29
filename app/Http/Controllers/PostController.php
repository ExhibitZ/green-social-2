<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy("created_at", "desc")->paginate(10);

        return view("posts.index", compact("posts"));
    }

    public function show(string $id)
    {
        $post = Post::find($id);
        $comments = $post->comments()->paginate(10);

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

    public function edit(string $id)
    {
        $post = Post::find($id);

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'message' => 'required | string | max:2048', 
        ]);

        $post = Post::find($id);
        $post->message = $request->message;
        $post->save();

        return redirect()->route('posts.index')->with('success','Post Updated successfully.');
    }

    public function destroy(string $id)
    {
        Post::find($id)->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
