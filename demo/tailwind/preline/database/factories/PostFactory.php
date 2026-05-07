<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'title' => fake()->sentence(),
            'content' => fake()->paragraphs(3, true),
            'is_published' => fake()->boolean(),
            'published_at' => fake()->dateTime(),
            'meta_data' => ['key' => 'value'],
        ];
    }
}
