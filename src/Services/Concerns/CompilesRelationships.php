<?php

declare(strict_types=1);

namespace CLCBWS\Fabric\Services\Concerns;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


trait CompilesRelationships
{
    /**
     * Compile public properties for related models in Livewire classes.
     */
    public function compileRelationshipProperties(array $relationships): string
    {
        $output = "";
        $defined = [];
        
        // BelongsTo properties
        foreach ($relationships['belongs_to'] ?? [] as $rel) {
            $modelVar = Str::plural(Str::lower(\class_basename($rel['model'])));
            if (!in_array($modelVar, $defined)) {
                $output .= "    public \$" . $modelVar . " = [];\n";
                $defined[] = $modelVar;
            }
        }

        // ManyToMany properties (IDs of selected items)
        foreach ($relationships['many_to_many'] ?? [] as $rel) {
            $modelVar = Str::plural(Str::lower(\class_basename($rel['model'])));
            if (!in_array($modelVar, $defined)) {
                $output .= "    public \$" . $modelVar . " = [];\n";
                $defined[] = $modelVar;
            }
            
            $selectedVar = "selected" . Str::studly($modelVar);
            if (!in_array($selectedVar, $defined)) {
                $output .= "    public \$" . $selectedVar . " = [];\n";
                $defined[] = $selectedVar;
            }
        }

        return $output;
    }

    /**
     * Compile fetching logic for related models in mount().
     */
    public function compileRelationshipFetching(array $relationships): string
    {
        $output = "";
        $fetched = [];
        
        // Fetch BelongsTo data
        foreach ($relationships['belongs_to'] ?? [] as $rel) {
            $modelVar = Str::plural(Str::lower(\class_basename($rel['model'])));
            if (!in_array($modelVar, $fetched)) {
                $modelClass = Str::startsWith($rel['model'], 'App\\') ? "\\" . $rel['model'] : "\\App\\Models\\" . $rel['model'];
                $output .= "        \$this->" . $modelVar . " = " . $modelClass . "::all();\n";
                $fetched[] = $modelVar;
            }
        }

        // Fetch ManyToMany data & current selections
        foreach ($relationships['many_to_many'] ?? [] as $rel) {
            $modelVar = Str::plural(Str::lower(\class_basename($rel['model'])));
            $modelClass = Str::startsWith($rel['model'], 'App\\') ? "\\" . $rel['model'] : "\\App\\Models\\" . $rel['model'];
            
            if (!in_array($modelVar, $fetched)) {
                $output .= "        \$this->" . $modelVar . " = " . $modelClass . "::all();\n";
                $fetched[] = $modelVar;
            }

            $output .= "        if (\$this->record->exists) {\n";
            $output .= "            \$this->selected" . Str::studly($modelVar) . " = \$this->record->" . Str::camel($modelVar) . "->pluck('id')->toArray();\n";
            $output .= "        }\n";
        }

        return $output;
    }

    /**
     * Compile relationship tables for the Show view.
     */
    protected function compileRelationshipTables(array $hasMany): string
    {
        $output = "";
        foreach ($hasMany as $rel) {
            $label = Str::plural($rel['model']);
            $output .= "
    <div class=\"mt-8 border-t border-gray-100 pt-8\">
        <h4 class=\"text-md font-bold text-gray-900 mb-4\">{$label}</h4>
        <livewire:fabric.{$rel['slug']}.table :filters=\"['{$rel['foreign_key']}' => \$record->id]\" />
    </div>\n";
        }
        return $output;
    }

    /**
     * Compile sync logic for ManyToMany relationships.
     */
    protected function compilePivotSync(array $manyToMany): string
    {
        $output = "";
        foreach ($manyToMany as $rel) {
            $modelVar = Str::plural(Str::lower($rel['model']));
            $selectedVar = "selected" . Str::studly($modelVar);
            $relationMethod = Str::camel($modelVar);
            
            $output .= "        \$this->form->{$relationMethod}()->sync(\$this->{$selectedVar});\n";
        }
        return $output;
    }
}
