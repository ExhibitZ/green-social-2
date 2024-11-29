<?php

namespace Database\Factories;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        $time = date("Y-m-d H:i:s");

        return [
            'message' => $this->faker->sentence(32),
            'likes' => 0,
            'created_at' => $time,
            'updated_at'=> $time
        ];
    }

    protected static function newFactory()
    {
        return PostFactory::new();
    }
}
