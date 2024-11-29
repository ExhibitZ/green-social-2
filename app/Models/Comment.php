<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $fillable = ['message', 'likes', 'image'];

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
    public function like()
    {
        return $this->hasOne(CommentLike::class);
    }
}
