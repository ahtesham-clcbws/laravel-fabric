<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Roles & Permissions
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $editorRole = Role::firstOrCreate(['name' => 'editor']);

        // 2. Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Fabric Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole($adminRole);

        // 3. Editor User
        $editor = User::firstOrCreate(
            ['email' => 'editor@example.com'],
            [
                'name' => 'Content Editor',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $editor->assignRole($editorRole);

        // 4. Website Content
        Category::factory(5)->create()->each(function ($category) {
            Post::factory(6)->create([
                'category_id' => $category->id,
                'is_published' => true,
            ]);
        });

        Tag::factory(10)->create();

        Service::create([
            'title' => 'Web Development',
            'slug' => 'web-development',
            'description' => 'Custom high-performance web applications built with Laravel and Livewire.',
            'icon' => 'code',
        ]);

        Service::create([
            'title' => 'UI/UX Design',
            'slug' => 'ui-ux-design',
            'description' => 'Beautiful, intuitive interfaces that your users will love.',
            'icon' => 'layout',
        ]);

        Service::create([
            'title' => 'Digital Marketing',
            'slug' => 'digital-marketing',
            'description' => 'Data-driven strategies to grow your online presence.',
            'icon' => 'trending-up',
        ]);

        Testimonial::create([
            'author' => 'Sarah Johnson',
            'content' => 'Laravel Fabric transformed our development workflow. We launched our MVP in record time!',
            'rating' => 5,
            'is_published' => true,
        ]);

        Faq::create([
            'question' => 'Is Laravel Fabric free?',
            'answer' => 'We offer a robust free tier for open-source projects and small startups.',
            'is_published' => true,
        ]);
        
        Faq::create([
            'question' => 'Does it support dark mode?',
            'answer' => 'Yes! All themes come with fully integrated dark mode support.',
            'is_published' => true,
        ]);
    }
}
