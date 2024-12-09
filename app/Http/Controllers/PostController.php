<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use File;
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
            'image' => 'image | max:2000'
        ]);

        $post = new Post();
        $post->user_id = auth()->user()->id;
        $post->message = $request->message;
        
        if (!is_null($request->image))
        {
            $file = $request->image;
            $filename = $post->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('images', $filename, 'public');

            $post->image = $filename;
        }

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
            'image' => 'image | max:2000'
        ]);

        $post = Post::find($postId);
        $post->message = $request->message;

        if (!is_null($request->image))
        {
            if (!is_null($post->image))
            {
                File::delete(public_path('storage/images' . $post->image));
            }
            $file = $request->image;
            $filename = $post->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('images', $filename, 'public');

            $post->image = $filename;
        }
        
        $post->save();

        return redirect()->route('posts.index')->with('success','Post Updated successfully.');
    }

    public function destroy(string $postId)
    {
        $post = Post::find($postId);

        if (!is_null($post->image))
        {
            File::delete(public_path('storage/images/' . $post->image));
        }
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
