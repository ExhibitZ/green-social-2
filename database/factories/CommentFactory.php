<?php

namespace Database\Factories;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        $time = now();

        return [
            'message' => $this->faker->sentence(32),
            'likes' => 0,
            'created_at' => $time,
            'updated_at'=> $time
        ];
    }

    protected static function newFactory()
    {
        return CommentFactory::new();
    }
}
