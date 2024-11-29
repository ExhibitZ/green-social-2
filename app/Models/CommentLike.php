<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentLike extends Model
{
    protected $table = 'comment_likes';

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id');
    }
}
