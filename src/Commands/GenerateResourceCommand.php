<?php

namespace CLCBWS\Fabric\Commands;

use CLCBWS\Fabric\Engines\Fabricator;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateResourceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fabric:generate {model} {--theme=} {--runtime=} {--tenant} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Forge a high-fidelity resource (Table, Editor, Stats) for a model';

    /**
     * Execute the console command.
     */
    public function handle(Fabricator $fabricator)
    {
        $model = $this->argument('model');
        $modelClass = $this->qualifyModel($model);

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
            ]);

            foreach ($files as $file) {
                $this->components->twoColumnDetail(
                    Str::after(base_path(), $file),
                    '<fg=green>Created</>'
                );
            }

            $this->components->info("Registered {$modelName} in global Spotlight Search.");
            
            $this->displayWisdom();

        } catch (\Exception $e) {
            $this->error("Forging failed: " . $e->getMessage());
        }
    }

    protected function displayWisdom()
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
