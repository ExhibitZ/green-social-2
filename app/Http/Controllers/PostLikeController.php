<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostLike;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
    public function like(string $postId)
    {
        $post = Post::find($postId);
        $likesExist = $post->like()->count();
        
        if (!$likesExist)
        {
            // add likes
            $like = new PostLike();
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
