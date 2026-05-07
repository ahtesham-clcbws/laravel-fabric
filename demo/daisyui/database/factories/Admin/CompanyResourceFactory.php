<?php

namespace Database\Factories\Admin;

use App\Enums\CompanyType;
use App\Models\Admin\CompanyResource;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyResourceFactory extends Factory
{
    protected $model = CompanyResource::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'description' => $this->faker->paragraph(),
            'email' => $this->faker->companyEmail(),
            'active' => $this->faker->boolean(80),
            'founded_at' => $this->faker->date(),
            'last_audit_at' => $this->faker->dateTime(),
            'settings' => [
                'employees' => $this->faker->numberBetween(10, 500),
                'hq' => $this->faker->city(),
                'tech_stack' => $this->faker->randomElements(['Laravel', 'Livewire', 'React', 'Vue', 'Tailwind'], 3),
            ],
            'type' => $this->faker->randomElement(CompanyType::cases()),
            'category_id' => Category::factory(),
        ];
    }
}
