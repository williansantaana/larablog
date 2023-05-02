<?php

namespace Database\Factories;

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
        return [
            'user_id' => rand(1, 10),
            'category_id' => rand(1, 16),
            'title' => fake()->realText(50),
            'content' => '<p>' . implode('</p><p>', fake()->paragraphs(rand(3, 6))) . '</p>',
            'cover' => 'covers/NgKYHbDDwZpRSO8sO12vaJWQQEbL0LueIvUc987M.webp',
        ];
    }
}
