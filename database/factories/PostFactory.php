<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = User::user()->pluck('id')->toArray();

        return [
            'title' => fake()->realText(50),
            'body' => fake()->realText(200),
            'image_url' => fake()->imageUrl(640,480),
            'user_id' => fake()->randomElement($userIds)
        ];
    }
}
