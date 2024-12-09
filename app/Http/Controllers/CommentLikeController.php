<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentLike;
use App\Models\Post;
use App\Models\PostLike;
use Auth;
use Illuminate\Http\Request;

class CommentLikeController extends Controller
{
    public function like(string $postId, string $commentId)
    {
        $comment = Comment::find($commentId);
        $likesExist = $comment->like()->count();
        $likesExist = CommentLike::where('user_id', Auth::user()->id)->where('comment_id', $commentId)->count();
        
        if (!$likesExist)
        {
            // add likes
            $like = new CommentLike();
            $like->user_id = Auth::user()->id;
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
