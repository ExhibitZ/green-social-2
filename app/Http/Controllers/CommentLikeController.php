<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentLike;
use App\Models\Post;
use App\Models\PostLike;
use Illuminate\Http\Request;

class CommentLikeController extends Controller
{
    public function like(string $postId, string $commentId)
    {
        $comment = Comment::find($commentId);
        $likesExist = $comment->like()->count();
        
        if (!$likesExist)
        {
            // add likes
            $like = new CommentLike();
            $comment->like()->save($like);
            $comment->likes = $comment->likes + 1;
            $comment->save();
        }
        else
        {
            // remove likes
            $comment->like()->delete();
            $comment->likes = $comment->likes - 1;
            $comment->save();
        }
    }
}
