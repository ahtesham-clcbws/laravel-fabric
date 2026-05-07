<?php

namespace Database\Seeders;

use App\Models\Admin\CompanyResource;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        // Create some categories
        $categories = Category::factory()->count(5)->create();

        // Create some tags
        $tags = collect(['Enterprise', 'Startup', 'SaaS', 'Fintech', 'AI', 'Open Source'])->map(function ($name) {
            return Tag::create(['name' => $name, 'slug' => strtolower($name)]);
        });

        // Create 50 companies
        CompanyResource::factory()
            ->count(50)
            ->recycle($categories)
            ->create()
            ->each(function ($company) use ($tags) {
                $company->tags()->attach($tags->random(3)->pluck('id'));
            });
    }
}
