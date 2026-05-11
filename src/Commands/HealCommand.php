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

    public function handle(Loom $loom, ViewCompiler $compiler, \CLCBWS\Fabric\Services\StructuralHealer $healer): void
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

        // 🧬 Lazarus 2.0: Class Healing
        $classPath = app_path('Livewire/Fabric/' . str_replace('\\', '/', $model) . '/Editor.php');
        if (File::exists($classPath)) {
            $this->healClass($classPath, $contract, $healer);
        }

        if (File::isDirectory($targetDir)) {
            $this->healEditor($targetDir . '/editor.blade.php', $contract, $compiler);
            $this->healTable($targetDir . '/table.blade.php', $contract, $compiler);
        }

        $this->info("Healing complete. Your architecture has been surgically updated.");
    }

    protected function healClass(string $path, array $contract, \CLCBWS\Fabric\Services\StructuralHealer $healer): void
    {
        $content = File::get($path);
        $this->line("  - Class: Structural audit initiating...");

        // Inject new validation rules into rules() method
        $pos = $healer->findMethodEnd($content, 'rules');
        if ($pos !== null) {
            $newRules = [];
            foreach ($contract['fields'] as $name => $field) {
                if ($name === 'id') continue;
                // Simple check if rule already exists in string
                if (!Str::contains($content, "'{$name}' =>")) {
                    $newRules[$name] = $field['rules'] ?? 'required';
                }
            }

            if (!empty($newRules)) {
                $this->line("    [Lazarus] Injecting " . count($newRules) . " new validation rules.");
                $ruleString = "";
                foreach ($newRules as $name => $rule) {
                    $ruleString .= "            '{$name}' => '{$rule}',\n";
                }
                
                // Inject before the closing brace of the rules() method
                $content = substr_replace($content, "\n" . $ruleString . "        ", $pos - 10, 0); // Offset adjustment for return statement
            }
        }

        File::put($path, $content);
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
            } elseif (preg_match_all('/wire:model(?:\.blur)?="form\.([^"]+)"/', $content, $matches, PREG_OFFSET_CAPTURE)) {
                // Find the last wire:model and its parent block
                $lastMatch = end($matches[0]);
                $offset = $lastMatch[1] + strlen($lastMatch[0]);
                
                // Find the next closing tag like </div> or </x-fabric::*> or the end of the line
                $nextNewline = strpos($content, "\n", $offset);
                if ($nextNewline !== false) {
                    $content = substr_replace($content, "\n    " . trim($fieldStub) . "\n", $nextNewline, 0);
                } else {
                    $content = str_replace('</form>', $fieldStub . "\n</form>", $content);
                }
            } else {
                // Final fallback: inject before the footer
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
