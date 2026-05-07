<?php

namespace Database\Seeders;

use App\Models\Admin\CompanyResource;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        // Create some categories
        $categories = Category::factory()->count(5)->create();

        // Create 50 companies
        CompanyResource::factory()
            ->count(50)
            ->recycle($categories)
            ->create();
    }
}
