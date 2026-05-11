<?php

declare(strict_types=1);

namespace CLCBWS\Fabric\Commands;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use CLCBWS\Fabric\Engines\Loom;
use Illuminate\Console\Command;

class HydrateCommand extends Command
{
    protected $signature = 'fabric:hydrate {model} {count=50}';
    protected $description = 'Forge realistic, context-aware dummy data for any model';

    public function handle(Loom $loom): void
    {
        $model = $this->argument('model');
        $count = (int) $this->argument('count');
        $modelClass = "App\\Models\\{$model}";

        if (!class_exists($modelClass)) {
            $this->error("Model {$modelClass} not found.");
            return;
        }

        $this->components->info("Forging {$count} Realistic Records for: {$modelClass}");

        $contract = $loom->introspect($modelClass);
        $faker = \Faker\Factory::create();

        $this->withProgressBar($count, function() use ($modelClass, $contract, $faker) {
            $data = [];
            foreach ($contract['fields'] as $name => $field) {
                $data[$name] = $this->guessFaker($name, $field['type'], $faker);
            }
            $modelClass::create($data);
        });

        $this->newLine();
        $this->info("✨ Hydration Complete. {$model} is now alive with data.");
    }

    protected function guessFaker(string $name, string $type, $faker): mixed
    {
        $name = strtolower($name);

        if (Str::contains($name, 'name')) return $faker->name;
        if (Str::contains($name, 'email')) return $faker->unique()->safeEmail;
        if (Str::contains($name, 'phone')) return $faker->phoneNumber;
        if (Str::contains($name, 'address')) return $faker->address;
        if (Str::contains($name, 'city')) return $faker->city;
        if (Str::contains($name, 'price') || Str::contains($name, 'amount')) return $faker->randomFloat(2, 10, 1000);
        if (Str::contains($name, 'content') || Str::contains($name, 'description')) return $faker->paragraph;
        if (Str::contains($name, 'title') || Str::contains($name, 'subject')) return $faker->sentence;
        if (Str::contains($name, 'image') || Str::contains($name, 'avatar')) return $faker->imageUrl();

        return match ($type) {
            'integer' => $faker->numberBetween(1, 100),
            'boolean' => $faker->boolean,
            'date', 'datetime' => $faker->dateTimeBetween('-1 year', 'now'),
            default => $faker->word,
        };
    }
}
