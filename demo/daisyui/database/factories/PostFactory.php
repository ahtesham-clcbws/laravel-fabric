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
            'title' => $title = fake()->sentence(),
            'slug' => \Illuminate\Support\Str::slug($title),
            'featured_image' => 'assets/images/blog_' . fake()->numberBetween(1, 3) . '.png',
            'content' => fake()->paragraphs(3, true),
            'is_published' => true,
            'published_at' => fake()->dateTime(),
            'meta_data' => ['key' => 'value'],
        ];
    }
}
