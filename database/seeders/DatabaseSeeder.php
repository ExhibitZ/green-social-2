<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'username',
            'email' => 'username@email.com',
            'password' => bcrypt('password')
        ]);

        $users = User::factory()->count(15)->create();
        $posts = Post::factory()->count(32)->make();

        foreach ($posts as $post)
        {
            $post->user_id = $users->random()->id;
            $post->save();

            $comments = Comment::factory()->count(12)->make();

            foreach ($comments as $comment)
            {
                $comment->user_id = $users->random()->id;
                $comment->post_id = $post->id;
                $comment->save();
            }
        }

        // Post::factory()->has(Comment::factory()->count(12), 'comments')->count(32)->create();
    }
}
