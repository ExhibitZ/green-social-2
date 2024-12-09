<?php

use App\Models\Post;
use App\Models\PostLike;
use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('test', function () {
    $user = User::find(1);
    $post = Post::find(1);
    $exists = PostLike::where('user_id', '1')->where('post_id', '1')->count();

    echo 'does it exist = ' . $user->post_likes()->count();
});