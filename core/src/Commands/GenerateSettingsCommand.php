<?php

declare(strict_types=1);

namespace CLCBWS\Fabric\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class GenerateSettingsCommand extends Command
{
    protected $signature = 'fabric:settings {class} {--theme=daisyui} {--force}';
    protected $description = 'Forge a high-fidelity settings editor for a Spatie Settings class';

    public function handle(): void
    {
        $class = $this->argument('class');
        $fullClass = $this->qualifyClass($class);

        if (!class_exists($fullClass)) {
            $this->error("Settings class {$fullClass} not found.");
            return;
        }

        $className = class_basename($fullClass);
        $theme = $this->option('theme');

        $this->components->info("Forging Settings Editor for: {$className}");

        $this->generatePhp($fullClass, $className);
        $this->generateBlade($className, $theme);
        $this->registerRoute($className);

        $this->components->info("Settings Editor for {$className} forged successfully!");
    }

    protected function generatePhp(string $fullClass, string $className): void
    {
        $stubPath = __DIR__ . '/../../stubs/livewire/common/Settings.php.stub';
        $stub = File::get($stubPath);
        $namespace = "App\\Livewire\\Fabric\\Settings";
        $path = app_path("Livewire/Fabric/Settings/{$className}.php");

        $content = str_replace(
            ['{{ NAMESPACE }}', '{{ SETTINGS_CLASS }}', '{{ CLASS_NAME }}', '{{ VIEW_PATH }}'],
            [$namespace, $fullClass, $className, "livewire.fabric.settings." . Str::kebab($className)],
            $stub
        );

        File::ensureDirectoryExists(dirname($path));
        File::put($path, $content);
        $this->line("<fg=green>Created:</> {$path}");
    }

    protected function generateBlade(string $className, string $theme): void
    {
        $stubPath = __DIR__ . "/../../stubs/livewire/{$theme}/settings.blade.php.stub";
        $stub = File::get($stubPath);
        $path = resource_path("views/livewire/fabric/settings/" . Str::kebab($className) . ".blade.php");

        File::ensureDirectoryExists(dirname($path));
        File::put($path, $stub);
        $this->line("<fg=green>Created:</> {$path}");
    }

    protected function registerRoute(string $className): void
    {
        $path = base_path('routes/fabric.php');
        if (!File::exists($path)) return;

        $slug = Str::kebab($className);
        $routeLine = "    Route::get('/settings/{$slug}', \\App\\Livewire\\Fabric\\Settings\\{$className}::class)->name('settings.{$slug}');";

        $content = File::get($path);
        if (str_contains($content, "settings.{$slug}")) return;

        if (str_contains($content, '// [FABRIC-RESOURCE-ROUTES]')) {
            $content = str_replace('// [FABRIC-RESOURCE-ROUTES]', "{$routeLine}\n    // [FABRIC-RESOURCE-ROUTES]", $content);
        }

        File::put($path, $content);
        $this->line("<fg=blue>Registered route for {$className}</>");
    }

    protected function qualifyClass(string $class): string
    {
        if (str_contains($class, '\\')) return $class;
        return "App\\Settings\\{$class}";
    }
}
