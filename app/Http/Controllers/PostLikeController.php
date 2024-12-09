<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostLike;
use Auth;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
    public function like(string $postId)
    {
        $post = Post::find($postId);
        $likesExist = PostLike::where('user_id', Auth::user()->id)->where('post_id', $postId)->count();
        
        if (!$likesExist)
        {
            // add likes
            $like = new PostLike();
            $like->user_id = Auth::user()->id;
            $post->like()->save($like);
            $post->likes = $post->likes + 1;
            $post->save();
        }
        else
        {
            // remove likes
            $post->like()->delete();
            $post->likes = $post->likes - 1;
            $post->save();
        }
    }
}
