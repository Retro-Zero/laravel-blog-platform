<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'post_id' => Post::factory(),
            'user_id' => $this->faker->optional()->randomElement([User::factory(), null]),
            'content' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['approved', 'pending', 'rejected']),
            'parent_id' => null,
            'is_approved' => false,
        ];
    }
}
