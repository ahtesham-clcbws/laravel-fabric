<?php

namespace CLCBWS\Fabric\Commands;

use CLCBWS\Fabric\Engines\Loom;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AnonCommand extends Command
{
    protected $signature = 'fabric:anon';
    protected $description = 'Irreversibly scrub PII from your database for safe development';

    public function handle(Loom $loom)
    {
        if (!$this->confirm('WARNING: This will IRREVERSIBLY change your database. Proceed?', false)) {
            return;
        }

        $this->components->info("Fabric Data-Anonymizer: Scrubbing PII...");

        $models = collect(\Illuminate\Support\Facades\File::files(app_path('Models')))
            ->map(fn($f) => "App\\Models\\" . $f->getFilenameWithoutExtension())
            ->filter(fn($m) => class_exists($m));

        $faker = \Faker\Factory::create();

        foreach ($models as $modelClass) {
            $contract = $loom->introspect($modelClass);
            $this->components->twoColumnDetail("Scrubbing: {$modelClass}", '<fg=yellow>Working...</>');

            $modelClass::query()->chunk(100, function($rows) use ($faker) {
                foreach ($rows as $row) {
                    $updates = [];
                    foreach ($row->getAttributes() as $key => $value) {
                        if ($val = $this->getAnonValue($key, $faker)) {
                            $updates[$key] = $val;
                        }
                    }
                    if (!empty($updates)) {
                        $row->update($updates);
                    }
                }
            });
        }

        $this->info("✨ Database successfully anonymized. It is now safe for development.");
    }

    protected function getAnonValue(string $key, $faker)
    {
        $key = strtolower($key);
        if (Str::contains($key, 'name')) return $faker->name;
        if (Str::contains($key, 'email')) return $faker->unique()->safeEmail;
        if (Str::contains($key, 'phone')) return $faker->phoneNumber;
        if (Str::contains($key, 'address')) return $faker->address;
        if (Str::contains($key, 'password')) return \Illuminate\Support\Facades\Hash::make('password');
        
        return null;
    }
}
