<?php

declare(strict_types=1);

namespace CLCBWS\Fabric\Services;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use CLCBWS\Fabric\Services\Concerns\CompilesForms;
use CLCBWS\Fabric\Services\Concerns\CompilesTables;
use CLCBWS\Fabric\Services\Concerns\CompilesRelationships;
use CLCBWS\Fabric\Services\Concerns\CompilesLogic;
use CLCBWS\Fabric\Services\Concerns\CompilesActivity;

readonly class ViewCompiler
{
    use CompilesForms, 
        CompilesTables, 
        CompilesRelationships, 
        CompilesLogic, 
        CompilesActivity;

    /**
     * Public accessors for Lab/Component usage.
     */
    public function compileFormFields(array $data): string 
    {
        return $this->traitCompileFormFields($data);
    }

    public function compileTableColumns(array $fields): string 
    {
        return $this->traitCompileTableColumns($fields);
    }

    /**
     * Compile the stub by replacing placeholders with actual data.
     */
    public function compile(string $stubContent, array $data): string
    {
        $placeholders = $this->buildPlaceholders($data);

        $content = str_replace(
            array_keys($placeholders),
            array_values($placeholders),
            $stubContent
        );

        // Handle Component Props Overrides
        if (isset($data['component_options'])) {
            $content = $this->compileComponentProps($content, $data['component_options']);
        }

        return $this->compileThemeColors($content);
    }

    /**
     * Dynamically override default values in @props based on CLI flags.
     */
    public function compileComponentProps(string $content, array $options): string
    {
        foreach ($options as $key => $value) {
            if ($value === null) continue;
            
            // Normalize 'type' flag to 'variant' prop for consistency
            $propKey = ($key === 'type') ? 'variant' : $key;

            // Match 'variant' => 'solid' and replace value
            $pattern = "/'{$propKey}'\s*=>\s*['\"]([^'\"]*)['\"]/";
            $replacement = "'{$propKey}' => '{$value}'";
            
            $content = preg_replace($pattern, $replacement, $content);
        }
        
        return $content;
    }

    /**
     * Replace theme color placeholders.
     */
    protected function compileThemeColors(string $content): string
    {
        $palette = (array) \config('fabric.palettes', [
            'primary' => 'indigo-600',
            'secondary' => 'gray-600',
            'accent' => 'indigo-400',
            'neutral' => 'gray-100',
        ]);
        
        $replacements = [];
        foreach ($palette as $key => $value) {
            $upperKey = \strtoupper($key);
            $replacements["{{ {$upperKey} }}"] = $value;
            
            // Extract base color (e.g. 'indigo' from 'indigo-600')
            $base = \explode('-', (string) $value)[0] ?? $value;
            $replacements["{{ {$upperKey}_BASE }}"] = $base;
        }

        return str_replace(array_keys($replacements), array_values($replacements), $content);
    }

    /**
     * Build the mapping of placeholders to values.
     */
    protected function buildPlaceholders(array $data): array
    {
        $modelClass = '\\' . ltrim($data['model'], '\\');
        $modelName = \class_basename($modelClass);
        
        return [
            '{{ MODEL_NAME }}' => $modelName,
            '{{ MODEL_CLASS }}' => ltrim($modelClass, '\\'),
            '{{ MODEL_CLASS_FQN }}' => $modelClass,
            '{{ MODEL_VARIABLE }}' => Str::camel($modelName),
            '{{ MODEL_SNAKE }}' => Str::snake($modelName),
            '{{ MODEL_PLURAL }}' => Str::plural(Str::camel($modelName)),
            '{{ RELATIONSHIP_TABLES }}' => $this->compileRelationshipTables($data['relationships']['has_many'] ?? []),
            '{{ NAMESPACE }}' => $this->getNamespace($data),
            '{{ VIEW_PATH }}' => $this->getViewPath($data),
            '{{ SEARCH_LOGIC }}' => $this->compileSearchLogic($data),
            '{{ FORM_FIELDS }}' => $this->compileFormFields($data),
            '{{ TABLE_COLUMNS }}' => $this->compileTableColumns($data['fields']),
            '{{ TABLE_COLUMNS_ARRAY }}' => "['" . implode("' => true, '", array_keys(array_filter($data['fields'], fn($f) => $f['fillable']))) . "' => true]",
            '{{ VALIDATION_RULES }}' => $this->compileValidationRules($data['fields']),
            '{{ TABLE_HEADER_ACTIONS }}' => $this->compileTableHeaderActions($data),
            '{{ TABLE_ROW_ACTIONS }}' => $this->compileTableRowActions($data),
            '{{ SHOW_ACTIVITY_LOG }}' => $this->compileShowActivityLog($data),
            '{{ TABLE_FILTERS }}' => $this->compileTableFilters($data),
            '{{ TABLE_FILTER_PROPERTIES }}' => $this->compileTableFilterProperties($data),
            '{{ TABLE_FILTER_LOGIC }}' => $this->compileTableFilterLogic($data),
            '{{ TABLE_ACTION_METHODS }}' => $this->compileTableActionMethods($data),
            '{{ TABLE_LISTENERS }}' => "protected \$listeners = ['" . Str::camel($modelName) . "-saved' => '\$refresh'];",
            '{{ FIELD_REACTIVE_HOOKS }}' => $this->compileFieldReactiveHooks($data['fields']),
            '{{ PRIMARY }}' => (string) \config('fabric.palettes.primary', 'indigo-600'),
            '{{ SECONDARY }}' => (string) \config('fabric.palettes.secondary', 'gray-600'),
            '{{ TEST_FIELD }}' => $this->getTestField($data['fields']),
            '{{ PIVOT_SYNC }}' => $this->compilePivotSync($data['relationships']['many_to_many'] ?? []),
            '{{ TABLE_ROWS }}' => $this->compileTableRows($data),
            '{{ SHOW_FIELDS }}' => $this->compileShowFields($data),
            '{{ TRASH_FILTER }}' => $this->compileTrashFilter($data),
            '{{ SEARCH_COL }}' => $this->compileSearchColumns($data['fields']),
            '{{ SORT_FIELD }}' => $data['options']['sort'] ?? 'id',
            '{{ SORT_DIRECTION }}' => $data['options']['direction'] ?? 'desc',
            '{{ VERSION }}' => (string) time(),
            '{{ VIEW_PATH_PREFIX }}' => 'livewire.fabric',
            '{{ PERMISSION_WRAPPER_START }}' => ($data['ecosystem']['permission'] ?? false) ? "@can('" . Str::snake($modelName) . ":manage')" : "",
            '{{ ACCESS_DENIED_UI }}' => ($data['ecosystem']['permission'] ?? false) ? "
    @else
    <div class=\"py-10 text-center\">
        <div class=\"opacity-50 mb-2\">🛡️</div>
        <div class=\"text-sm font-bold opacity-50 uppercase tracking-widest\">Access Denied</div>
        <p class=\"text-xs opacity-40 mt-1\">You do not have permission to manage this resource.</p>
        <button type=\"button\" wire:click=\"\$dispatch('closeModal')\" class=\"btn btn-ghost btn-sm mt-4\">Close</button>
    </div>" : "",
            '{{ PERMISSION_WRAPPER_END }}' => ($data['ecosystem']['permission'] ?? false) ? "@endcan" : "",
        ];
    }

    protected function getNamespace(array $data): string
    {
        $fullModelClass = $data['model'];
        $modelName = \class_basename($fullModelClass);
        
        $subNamespace = \str_replace(['App/Models', 'App'], '', \dirname(\str_replace('\\', '/', $fullModelClass)));
        $subNamespace = \str_replace('/', '\\', $subNamespace);
        $subNamespace = \trim($subNamespace, '\\');

        $baseNamespace = (string) \config('fabric.output.namespace', 'App\\Livewire\\Fabric');
        $baseNamespace = \trim($baseNamespace, '\\');

        return !empty($subNamespace) 
            ? "{$baseNamespace}\\{$subNamespace}\\{$modelName}" 
            : "{$baseNamespace}\\{$modelName}";
    }

    public function getViewPath(array $data): string
    {
        $fullModelClass = $data['model'];
        $modelName = \class_basename($fullModelClass);
        
        $subNamespace = \str_replace(['App/Models', 'App'], '', \dirname(\str_replace('\\', '/', $fullModelClass)));
        $subNamespaceParts = \explode('/', \str_replace('\\', '/', $subNamespace));
        $kebabSubNamespace = \implode('.', \array_map(fn($p) => Str::kebab($p), \array_filter($subNamespaceParts)));

        $modelKebab = Str::kebab($modelName);

        return !empty($kebabSubNamespace)
            ? "livewire.fabric.{$kebabSubNamespace}.{$modelKebab}"
            : "livewire.fabric.{$modelKebab}";
    }

    public function getLivewireComponentName(array $data, string $suffix = 'Editor'): string
    {
        $namespace = $this->getNamespace($data);
        $model = \class_basename($data['model']);
        $fullClass = "{$namespace}\\{$suffix}";
        
        $relativeClass = \str_replace('App\\Livewire\\', '', $fullClass);
        $parts = \explode('\\', $relativeClass);
        
        return \implode('.', \array_map(fn($p) => Str::kebab($p), $parts));
    }

    protected function compileShowFields(array $data): string
    {
        $output = "";
        foreach ($data['fields'] as $name => $field) {
            $label = Str::headline($name);
            $output .= "
                <div class=\"px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 " . (\config('fabric.theme') === 'daisyui' ? 'border-b border-base-200' : 'border-b border-gray-200') . "\">
                    <dt class=\"text-sm font-medium " . (\config('fabric.theme') === 'daisyui' ? 'text-base-content opacity-70' : 'text-gray-900') . "\">{$label}</dt>
                    <dd class=\"mt-1 text-sm leading-6 " . (\config('fabric.theme') === 'daisyui' ? 'text-base-content' : 'text-gray-700') . " sm:col-span-2 sm:mt-0\">{{ \$record->{$name} }}</dd>
                </div>";
        }
        return $output;
    }

    protected function compileTrashFilter(array $data): string
    {
        if (!($data['soft_deletes'] ?? false)) {
            return "";
        }

        return "
            <div class=\"flex items-center gap-2\">
                <label class=\"text-xs font-bold text-gray-500 uppercase\">Show Trashed</label>
                <input type=\"checkbox\" wire:model.live=\"showTrashed\" class=\"rounded border-gray-300 text-{{ PRIMARY }} shadow-sm focus:ring-{{ PRIMARY }}\">
            </div>";
    }


}
