<?php

declare(strict_types=1);

namespace CLCBWS\Fabric\Commands;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use CLCBWS\Fabric\Engines\Loom;
use CLCBWS\Fabric\Services\ViewCompiler;
use Illuminate\Console\Command;
use CLCBWS\Fabric\Services\StructuralHealer;

class HealCommand extends Command
{
    protected $signature = 'fabric:heal {model} {--dry-run}';
    protected $description = 'Surgically patch existing Fabric components with new database columns';

    public function handle(Loom $loom, ViewCompiler $compiler, StructuralHealer $healer): void
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

        // 1. Heal Class
        $classPath = app_path('Livewire/Fabric/' . str_replace('\\', '/', $model) . '/Editor.php');
        if (File::exists($classPath)) {
            $this->processFile($classPath, function($content) use ($contract, $healer) {
                return $this->healClass($content, $contract, $healer);
            });
        }

        // 2. Heal Views
        if (File::isDirectory($targetDir)) {
            $this->processFile($targetDir . '/editor.blade.php', function($content) use ($contract, $compiler) {
                return $this->healEditor($content, $contract, $compiler);
            });

            $this->processFile($targetDir . '/table.blade.php', function($content) use ($contract, $compiler) {
                return $this->healTable($content, $contract, $compiler);
            });
        }

        $this->info("Healing process completed.");
    }

    protected function processFile(string $path, callable $healer): void
    {
        if (!File::exists($path)) return;

        $original = File::get($path);
        $healed = $healer($original);

        if ($original === $healed) {
            $this->components->twoColumnDetail(basename($path), '<fg=gray>No drift detected</>');
            return;
        }

        if ($this->option('dry-run')) {
            $this->showDiff($path, $original, $healed);
        } else {
            File::put($path, $healed);
            $this->components->twoColumnDetail(basename($path), '<fg=green>Healed</>');
        }
    }

    protected function showDiff(string $path, string $old, string $new): void
    {
        $this->line("\n<fg=yellow;options=bold>DIFF PREVIEW: {$path}</>");
        $this->line("<fg=gray>--------------------------------------------------</>");
        
        $oldLines = explode("\n", $old);
        $newLines = explode("\n", $new);

        foreach ($newLines as $i => $line) {
            if (!isset($oldLines[$i]) || $oldLines[$i] !== $line) {
                $this->line("<fg=green>+ {$line}</>");
            } else {
                $this->line("  {$line}");
            }
        }
        $this->line("<fg=gray>--------------------------------------------------</>\n");
    }

    protected function healClass(string $content, array $contract, StructuralHealer $healer): string
    {
        // Inject new validation rules into rules() method
        $pos = $healer->findMethodEnd($content, 'rules');
        if ($pos !== null) {
            $newRules = [];
            foreach ($contract['fields'] as $name => $field) {
                if ($name === 'id') continue;
                if (!Str::contains($content, "'{$name}' =>")) {
                    $newRules[$name] = $field['rules'] ?? 'required';
                }
            }

            if (!empty($newRules)) {
                $ruleString = "";
                foreach ($newRules as $name => $rule) {
                    $ruleString .= "            '{$name}' => '{$rule}',\n";
                }
                
                return substr_replace($content, "\n" . $ruleString . "        ", $pos - 10, 0);
            }
        }

        return $content;
    }

    protected function healEditor(string $content, array $contract, ViewCompiler $compiler): string
    {
        $existingFields = [];
        preg_match_all('/wire:model(?:\.blur)?="form\.([^"]+)"/', $content, $matches);
        $existingFields = $matches[1] ?? [];

        $newFields = array_diff(array_keys($contract['fields']), $existingFields);
        
        if (empty($newFields)) return $content;

        foreach ($newFields as $fieldName) {
            if ($fieldName === 'id' || !$contract['fields'][$fieldName]['fillable']) continue;
            
            $fieldStub = $compiler->compileFormFields([
                'fields' => [$fieldName => $contract['fields'][$fieldName]],
                'ecosystem' => $contract['ecosystem'],
                'relationships' => $contract['relationships'],
            ]);

            if (Str::contains($content, '<!-- [FABRIC-HEAL-FORM] -->')) {
                $content = str_replace('<!-- [FABRIC-HEAL-FORM] -->', $fieldStub . "\n    <!-- [FABRIC-HEAL-FORM] -->", $content);
            } else {
                $content = str_replace('</form>', $fieldStub . "\n</form>", $content);
            }
        }

        return $content;
    }

    protected function healTable(string $content, array $contract, ViewCompiler $compiler): string
    {
        // Table healing logic placeholder
        return $content;
    }
}
