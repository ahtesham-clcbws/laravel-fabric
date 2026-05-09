<?php

declare(strict_types=1);

namespace CLCBWS\Fabric\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ModelWeaver
{
    /**
     * Weave missing relationship methods into the model.
     */
    public function weave(string $modelClass, array $relationships): void
    {
        $reflection = new \ReflectionClass($modelClass);
        $path = $reflection->getFileName();

        if (!$path || !File::exists($path)) {
            return;
        }

        $content = File::get($path);
        $originalContent = $content;

        // 1. Weave BelongsTo
        foreach ($relationships['belongs_to'] ?? [] as $foreignKey => $rel) {
            $methodName = Str::camel(Str::singular($rel['table']));
            if (!method_exists($modelClass, $methodName)) {
                $content = $this->injectRelationship($content, $methodName, "belongsTo", $rel['model']);
            }
        }

        // 2. Weave HasMany
        foreach ($relationships['has_many'] ?? [] as $table => $rel) {
            $methodName = Str::camel(str_replace('.', '_', $table));
            if (!method_exists($modelClass, $methodName)) {
                $content = $this->injectRelationship($content, $methodName, "hasMany", $rel['model']);
            }
        }

        if ($content !== $originalContent) {
            File::put($path, $content);
        }
    }

    protected function injectRelationship(string $content, string $name, string $type, string $targetModel): string
    {
        $targetFQN = '\\' . ltrim($targetModel, '\\');
        $returnType = ucfirst($type);
        
        $method = "\n    public function {$name}(): \\Illuminate\\Database\\Eloquent\\Relations\\{$returnType}\n";
        $method .= "    {\n";
        $method .= "        return \$this->{$type}({$targetFQN}::class);\n";
        $method .= "    }\n";

        // Find the last closing brace and inject before it
        $pos = strrpos($content, '}');
        if ($pos !== false) {
            return substr_replace($content, $method, $pos, 0);
        }

        return $content;
    }
}
