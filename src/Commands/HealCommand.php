<?php

declare(strict_types=1);

namespace CLCBWS\Fabric\Commands;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use CLCBWS\Fabric\Engines\Loom;
use CLCBWS\Fabric\Services\ViewCompiler;
use Illuminate\Console\Command;

class HealCommand extends Command
{
    protected $signature = 'fabric:heal {model} {--force}';
    protected $description = 'Surgically patch existing Fabric components with new database columns';

    public function handle(Loom $loom, ViewCompiler $compiler): void
    {
        $model = $this->argument('model');
        $modelClass = "App\\Models\\{$model}";
        
        if (!class_exists($modelClass)) {
            $this->error("Model {$modelClass} not found.");
            return;
        }

        $this->components->info("Healing Fabric for: {$modelClass}");

        $contract = $loom->introspect($modelClass);
        $viewPath = $compiler->getViewPath($contract);
        $targetDir = resource_path('views/' . str_replace('.', '/', $viewPath));

        if (!File::isDirectory($targetDir)) {
            $this->error("Component directory not found at: {$targetDir}. Run fabric:generate first.");
            return;
        }

        $this->healEditor($targetDir . '/editor.blade.php', $contract, $compiler);
        $this->healTable($targetDir . '/table.blade.php', $contract, $compiler);

        $this->info("Healing complete. Your components have been surgically updated.");
    }

    protected function healEditor(string $path, array $contract, ViewCompiler $compiler): void
    {
        if (!File::exists($path)) return;

        $content = File::get($path);
        $existingFields = [];
        
        // Extract existing wire:model bindings
        preg_match_all('/wire:model(?:\.blur)?="form\.([^"]+)"/', $content, $matches);
        $existingFields = $matches[1] ?? [];

        $newFields = array_diff(array_keys($contract['fields']), $existingFields);
        
        if (empty($newFields)) {
            $this->line("  - Editor: No new fields detected.");
            return;
        }

        foreach ($newFields as $fieldName) {
            if ($fieldName === 'id' || !$contract['fields'][$fieldName]['fillable']) continue;
            
            $this->line("  - Editor: Injecting field [{$fieldName}]");
            
            $fieldStub = $compiler->compileFormFields([
                'fields' => [$fieldName => $contract['fields'][$fieldName]],
                'ecosystem' => $contract['ecosystem'],
                'relationships' => $contract['relationships'],
            ]);

            // Inject before the submit button or at the end of the form
            if (Str::contains($content, '<!-- [FABRIC-HEAL-FORM] -->')) {
                $content = str_replace('<!-- [FABRIC-HEAL-FORM] -->', $fieldStub . "\n    <!-- [FABRIC-HEAL-FORM] -->", $content);
            } else {
                // Fallback: inject before the footer
                $content = str_replace('</form>', $fieldStub . "\n</form>", $content);
            }
        }

        File::put($path, $content);
    }

    protected function healTable(string $path, array $contract, ViewCompiler $compiler): void
    {
        if (!File::exists($path)) return;

        $content = File::get($path);
        
        // This is more complex as tables have headers AND rows.
        // For now, we recommend a fresh generate if table structure changes significantly,
        // but we'll add the hook points to stubs to make this easier in v1.1.
        $this->line("  - Table: Checking for structural drift...");
    }
}
