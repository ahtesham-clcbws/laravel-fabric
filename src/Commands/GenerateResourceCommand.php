<?php

declare(strict_types=1);

namespace CLCBWS\Fabric\Commands;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use CLCBWS\Fabric\Engines\Fabricator;
use Illuminate\Console\Command;

class GenerateResourceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fabric:generate {model} {--theme=} {--runtime=} {--tenant} {--force} {--sort=id} {--direction=desc}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Forge a high-fidelity resource (Table, Editor, Stats) for a model';

    /**
     * Execute the console command.
     */
    public function handle(Fabricator $fabricator): void
    {
        $model = $this->argument('model');
        $modelClass = $this->qualifyModel($model);
        $modelName = \class_basename($modelClass);

        if (!class_exists($modelClass)) {
            $this->error("Model {$modelClass} not found.");
            return;
        }

        $this->components->info("Forging Fabric for: {$modelClass}");

        try {
            $files = $fabricator->build($modelClass, [
                'theme' => $this->option('theme'),
                'runtime' => $this->option('runtime'),
                'tenant' => $this->option('tenant'),
                'sort' => $this->option('sort'),
                'direction' => $this->option('direction'),
            ]);

            foreach ($files as $file) {
                $this->components->twoColumnDetail(
                    Str::after(base_path(), $file),
                    '<fg=green>Created</>'
                );
            }

            $this->registerInSearch($modelClass);
            $this->registerRoute($modelClass);
            
            $this->displayWisdom();

        } catch (\Exception $e) {
            $this->error("Forging failed: " . $e->getMessage());
        }
    }

    protected function displayWisdom(): void
    {
        $quotes = [
            "Any fool can write code that a computer can understand. Good programmers write code that humans can understand. — Martin Fowler",
            "Clean code always looks like it was written by someone who cares. — Michael Feathers",
            "Explicit is better than implicit. — The Zen of Python",
            "Measuring programming progress by lines of code is like measuring aircraft building progress by weight. — Bill Gates",
            "The best way to get a project done faster is to start sooner. — Jim Highsmith",
            "Talk is cheap. Show me the code. — Linus Torvalds",
            "First, solve the problem. Then, write the code. — John Johnson",
            "Code is like humor. If you have to explain it, it’s bad. — Cory House",
        ];

        $quote = $quotes[array_rand($quotes)];
        $this->newLine();
        $this->line("  <fg=gray;italic>“{$quote}”</>");
        $this->newLine();
    }

    /**
     * Register the resource in routes/fabric.php.
     */
    protected function registerRoute(string $modelClass): void
    {
        $path = base_path('routes/fabric.php');
        if (!File::exists($path)) return;

        $modelName = class_basename($modelClass);
        $routePrefix = Str::kebab($modelName);
        $normalizedClass = \str_replace('/', '\\', $modelClass);
        $normalizedDir = \str_replace('/', '\\', \dirname(\str_replace('\\', '/', $normalizedClass)));
        $subNamespace = \str_replace(['App\\Models\\', 'App\\Models', 'App\\'], '', $normalizedDir);
        $subNamespace = \str_replace(['/', '\\'], '\\', $subNamespace);
        $slashPrefix = !empty($subNamespace) ? \trim($subNamespace, '\\') . "\\" : "";
        
        $componentClass = "App\\Livewire\\Fabric\\{$slashPrefix}{$modelName}\\Table";
        $routeLine = "    Route::get('/{$routePrefix}', \\{$componentClass}::class)->name('{$routePrefix}.index');";

        $content = File::get($path);
        
        // If force, remove old route first
        if ($this->option('force')) {
            $content = preg_replace('/Route::get\(\'\/' . $routePrefix . '\'.*?;/s', '', $content);
        }

        if (str_contains($content, "fabric.{$routePrefix}.index")) return;

        if (str_contains($content, '// [FABRIC-RESOURCE-ROUTES]')) {
            $content = str_replace('// [FABRIC-RESOURCE-ROUTES]', "{$routeLine}\n    // [FABRIC-RESOURCE-ROUTES]", $content);
        } else {
            // Fallback: append before the last closing brace of the group
            $content = preg_replace('/}\);(\s*\/\/ Guest Routes|$)/', "    {$routeLine}\n});$1", $content);
        }

        File::put($path, $content);
        $this->components->info("Registered {$modelName} routes in routes/fabric.php.");
    }

    /**
     * Register the model in the global SearchRegistry.
     */
    protected function registerInSearch(string $modelClass): void
    {
        try {
            $registry = app(\CLCBWS\Fabric\Services\SearchRegistry::class);
            $modelName = class_basename($modelClass);
            $routePrefix = Str::kebab($modelName);
            
            $registry->registerResource(
                $modelClass, 
                "fabric.{$routePrefix}.index",
                '📦'
            );
            
            $this->components->info("Registered {$modelName} in global Spotlight Search.");
        } catch (\Exception $e) {
            $this->warn("Could not register in search: " . $e->getMessage());
        }
    }

    protected function qualifyModel(string $model): string
    {
        if (str_contains($model, '\\')) {
            return $model;
        }

        return "App\\Models\\{$model}";
    }
}
