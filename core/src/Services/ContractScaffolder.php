<?php

declare(strict_types=1);

namespace CLCBWS\Fabric\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ContractScaffolder
{
    /**
     * 🔗 Cross-Module Decoupling
     * Scaffolds a PHP Interface when a relationship crosses module boundaries.
     */
    public function scaffold(string $modelClass, array $relationships): void
    {
        $currentModule = $this->getModuleName($modelClass);

        foreach ($relationships as $relationship) {
            $relatedModel = $relationship['model'] ?? null;
            if (!$relatedModel) continue;

            $relatedModule = $this->getModuleName($relatedModel);

            // If modules differ, forge a contract
            if ($currentModule !== $relatedModule) {
                $this->forgeContract($relatedModel);
            }
        }
    }

    protected function getModuleName(string $class): string
    {
        // Extracts the first namespace segment after App\Models
        $segments = explode('\\', str_replace(['App\\Models\\', 'App\\Models'], '', $class));
        return $segments[0] ?: 'Core';
    }

    protected function forgeContract(string $modelClass): void
    {
        $modelName = class_basename($modelClass);
        $module = $this->getModuleName($modelClass);
        
        $contractNamespace = "App\\Contracts\\{$module}";
        $contractName = "{$modelName}Contract";
        $path = app_path("Contracts/{$module}/{$contractName}.php");

        if (File::exists($path)) return;

        if (!File::isDirectory(dirname($path))) {
            File::makeDirectory(dirname($path), 0755, true);
        }

        $stub = <<<PHP
<?php

declare(strict_types=1);

namespace {$contractNamespace};

/**
 * 📜 FORGED BY FABRIC (Service Contract)
 * This interface decouples the {$module} module from other modules.
 */
interface {$contractName}
{
    // Define shared methods for cross-module communication here
}
PHP;

        File::put($path, $stub);
    }
}
