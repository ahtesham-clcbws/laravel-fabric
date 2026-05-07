<?php

namespace CLCBWS\Fabric\Services;

use Illuminate\Support\Str;

readonly class ViewCompiler
{
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

        return $this->compileThemeColors($content);
    }

    /**
     * Replace theme color placeholders.
     */
    protected function compileThemeColors(string $content): string
    {
        $palette = \config('fabric.palettes', [
            'primary' => 'indigo-600',
            'secondary' => 'gray-600',
            'accent' => 'indigo-400',
            'neutral' => 'gray-100',
        ]);
        
        $replacements = [
            '{{ PRIMARY }}'   => $palette['primary'],
            '{{ SECONDARY }}' => $palette['secondary'],
            '{{ ACCENT }}'    => $palette['accent'],
            '{{ NEUTRAL }}'   => $palette['neutral'],
        ];

        return str_replace(array_keys($replacements), array_values($replacements), $content);
    }

    /**
     * Build the mapping of placeholders to values.
     */
    protected function buildPlaceholders(array $data): array
    {
        $modelClass = $data['model'];
        $modelName = \class_basename($modelClass);
        
        return [
            '{{ MODEL_NAME }}' => $modelName,
            '{{ MODEL_CLASS }}' => $modelClass,
            '{{ MODEL_VARIABLE }}' => Str::camel($modelName),
            '{{ MODEL_SNAKE }}' => Str::snake($modelName),
            '{{ MODEL_PLURAL }}' => Str::plural(Str::camel($modelName)),
            '{{ RELATIONSHIP_TABLES }}' => $this->compileRelationshipTables($data['relationships']['has_many'] ?? []),
            '{{ NAMESPACE }}' => $this->getNamespace($data),
            '{{ VIEW_PATH }}' => $this->getViewPath($data),
            '{{ VIEW_PATH_PREFIX }}' => 'livewire.fabric',
            '{{ SEARCH_LOGIC }}' => $this->compileSearchLogic($data),
            // Complex logic for fields will be handled by specific methods
            '{{ FORM_FIELDS }}' => $this->compileFormFields($data),
            '{{ TABLE_COLUMNS }}' => $this->compileTableColumns($data['fields']),
            '{{ VALIDATION_RULES }}' => $this->compileValidationRules($data['fields']),
            '{{ TABLE_HEADER_ACTIONS }}' => $this->compileTableHeaderActions($data),
            '{{ TABLE_ROW_ACTIONS }}' => $this->compileTableRowActions($data),
            '{{ SHOW_ACTIVITY_LOG }}' => $this->compileShowActivityLog($data),
            '{{ TABLE_FILTERS }}' => $this->compileTableFilters($data),
            '{{ TABLE_FILTER_PROPERTIES }}' => $this->compileTableFilterProperties($data),
            '{{ TABLE_FILTER_LOGIC }}' => $this->compileTableFilterLogic($data),
            '{{ TABLE_ACTION_METHODS }}' => $this->compileTableActionMethods($data),
            '{{ FIELD_REACTIVE_HOOKS }}' => $this->compileFieldReactiveHooks($data['fields']),
            '{{ PRIMARY }}' => \config('fabric.palettes.primary', 'indigo-600'),
            '{{ SECONDARY }}' => \config('fabric.palettes.secondary', 'gray-600'),
            '{{ TEST_FIELD }}' => $this->getTestField($data['fields']),
            '{{ PIVOT_SYNC }}' => $this->compilePivotSync($data['relationships']['many_to_many'] ?? []),
            '{{ TABLE_ROWS }}' => $this->compileTableRows($data),
            '{{ SHOW_FIELDS }}' => $this->compileShowFields($data),
            '{{ TRASH_FILTER }}' => $this->compileTrashFilter($data),
            '{{ SOFT_DELETE_ACTIONS }}' => $this->compileSoftDeleteActions($data),
            '{{ VERSION }}' => time(),
        ];
    }

    protected function getNamespace(array $data): string
    {
        $fullModelClass = $data['model'];
        $modelName = \class_basename($fullModelClass);
        
        // Extract sub-namespace
        $subNamespace = \str_replace(['App/Models', 'App'], '', \dirname(\str_replace('\\', '/', $fullModelClass)));
        $subNamespace = \str_replace('/', '\\', $subNamespace);
        $subNamespace = \trim($subNamespace, '\\');

        $baseNamespace = \config('fabric.output.namespace', 'App\\Livewire\\Fabric');
        $baseNamespace = \trim($baseNamespace, '\\');

        return !empty($subNamespace) 
            ? "{$baseNamespace}\\{$subNamespace}\\{$modelName}" 
            : "{$baseNamespace}\\{$modelName}";
    }

    public function getViewPath(array $data): string
    {
        $fullModelClass = $data['model'];
        $modelName = \class_basename($fullModelClass);
        
        // Extract sub-namespace in kebab-case
        $subNamespace = \str_replace(['App/Models', 'App'], '', \dirname(\str_replace('\\', '/', $fullModelClass)));
        $subNamespaceParts = \explode('/', \str_replace('\\', '/', $subNamespace));
        $kebabSubNamespace = \implode('.', \array_map(fn($p) => Str::kebab($p), \array_filter($subNamespaceParts)));

        $prefix = \config('fabric.theme', 'tailwind');
        $modelKebab = Str::kebab($modelName);

        return !empty($kebabSubNamespace)
            ? "livewire.fabric.{$kebabSubNamespace}.{$modelKebab}"
            : "livewire.fabric.{$modelKebab}";
    }

    public function getLivewireComponentName(array $data, string $suffix = 'Editor'): string
    {
        $namespace = $this->getNamespace($data);
        $model = \class_basename($data['model']);
        $fullClass = "{$namespace}\\{$model}{$suffix}";
        
        // Convert App\Livewire\Fabric\App\Models\Post\PostEditor 
        // to fabric.app.models.post.post-editor
        $relativeClass = \str_replace('App\\Livewire\\', '', $fullClass);
        $parts = \explode('\\', $relativeClass);
        
        return \implode('.', \array_map(fn($p) => Str::kebab($p), $parts));
    }

    protected function compileSearchLogic(array $data): string
    {
        $output = "";
        $fields = $data['fields'];
        $isScout = $data['ecosystem']['scout'] ?? false;
        $modelName = \class_basename($data['model']);

        if ($isScout) {
            return "                    \$q->whereIn('id', {$modelName}::search(\$this->search)->keys());\n";
        }
        
        $searchable = array_filter($fields, fn($f) => $f['searchable']);
        
        foreach ($searchable as $name => $field) {
            $output .= "                    \$q->orWhere('{$name}', 'like', \"%{\$this->search}%\");\n";
        }
        
        return $output;
    }

    /**
     * Compile form field stubs based on column types.
     */
    public function compileFormFields(array $data): string
    {
        $output = "";
        $fields = $data['fields'];
        $ecosystem = $data['ecosystem'];

        foreach ($fields as $name => $field) {
            if (!$field['fillable']) continue;

            $label = Str::headline($name);
            
            // Handle Sluggable (Readonly)
            if ($ecosystem['sluggable'] && $name === 'slug') {
                $output .= "    <x-fabric::input label=\"{$label}\" wire:model.blur=\"form.{$name}\" readonly class=\"bg-gray-50\" />\n";
                continue;
            }

            // Handle Translatable
            if ($ecosystem['translatable'] ?? false) {
                 $locales = \config('fabric.locales', ['en', 'es', 'fr']);
                 $output .= "    <div x-data=\"{ activeTab: '{$locales[0]}' }\" class=\"space-y-2\">\n";
                 $output .= "        <label class=\"text-sm font-medium text-gray-700\">{$label}</label>\n";
                 $output .= "        <div class=\"flex gap-2 border-b\">\n";
                 foreach ($locales as $locale) {
                     $output .= "            <button @click=\"activeTab = '{$locale}'\" :class=\"activeTab === '{$locale}' ? 'border-{{ PRIMARY }} text-{{ PRIMARY }}' : 'border-transparent text-gray-500'\" class=\"px-3 py-1 border-b-2 text-xs font-bold uppercase transition\">{$locale}</button>\n";
                 }
                 $output .= "        </div>\n";
                 foreach ($locales as $locale) {
                     $output .= "        <div x-show=\"activeTab === '{$locale}'\">\n";
                     $output .= "            " . $this->getFormFieldStub($field, "{$label} ({$locale})", "form.{$name}.{$locale}") . "\n";
                     $output .= "        </div>\n";
                 }
                 $output .= "    </div>\n";
                 continue;
            }

            // Handle Media (Spatie)
            if ($field['is_media'] ?? false) {
                 $isMultiple = Str::plural($name) === $name;
                 $component = $isMultiple ? 'gallery' : 'file-upload';
                 $output .= "    <x-fabric::{$component} label=\"{$label}\" wire:model.blur=\"form.{$name}\" />\n";
                 continue;
            }

            // Handle JSON/Attributes (Lunar-Grade)
            if ($field['is_json'] ?? false) {
                 $output .= "    <x-fabric::textarea label=\"{$label}\" wire:model.blur=\"form.{$name}\" />\n";
                 continue;
            }

            $output .= $this->getFormFieldStub($field, $label) . "\n";
        }

        // Add Tag Input if enabled
        if ($ecosystem['tags'] ?? false) {
            $output .= "    <x-fabric::tags-input label=\"Tags\" wire:model.blur=\"form.tags\" />\n";
        }

        // Add ManyToMany Selects
        foreach ($data['relationships']['many_to_many'] ?? [] as $rel) {
            $label = Str::plural($rel['model']);
            $modelVar = Str::plural(Str::lower($rel['model']));
            $selectedVar = "selected" . Str::studly($modelVar);
            
            $output .= "
    <x-fabric::select label=\"{$label}\" wire:model.blur=\"{$selectedVar}\" multiple>
        @foreach(\${$modelVar} as \$item)
            <option value=\"{{ \$item->id }}\">{{ \$item->{$rel['label']} }}</option>
        @endforeach
    </x-fabric::select>\n";
        }

        // Add Multi-Tenant Hidden Field
        if ($data['tenant'] ?? false) {
            $tenantKey = \config('fabric.tenant_key', 'team_id');
            $output .= "    <input type=\"hidden\" wire:model=\"form.{$tenantKey}\" value=\"{{ auth()->user()->{$tenantKey} }}\" />\n";
        }

        return $output;
    }

    protected function getFormFieldStub(array $field, string $label, ?string $wireModel = null): string
    {
        $name = $field['name'];
        $model = $wireModel ?? "form.{$name}";
        $theme = \config('fabric.theme', 'tailwind');
        
        if ($theme === 'daisyui') {
            return match($field['type']) {
                'number'   => "    <div class=\"form-control w-full\"><label class=\"label\"><span class=\"label-text\">{$label}</span></label><input type=\"number\" wire:model.blur=\"{$model}\" class=\"input input-bordered w-full\" step=\"1\" /></div>",
                'boolean'  => "    <div class=\"form-control\"><label class=\"label cursor-pointer\"><span class=\"label-text\">{$label}</span><input type=\"checkbox\" wire:model.blur=\"{$model}\" class=\"toggle toggle-primary\" /></label></div>",
                'textarea' => "    <div class=\"form-control w-full\"><label class=\"label\"><span class=\"label-text\">{$label}</span></label><textarea wire:model.blur=\"{$model}\" class=\"textarea textarea-bordered h-24\"></textarea></div>",
                'relationship' => $this->compileRelationshipSelect($field, $model),
                'enum'     => $this->compileEnumField($field, $model),
                default    => "    <div class=\"form-control w-full\"><label class=\"label\"><span class=\"label-text\">{$label}</span></label><input type=\"text\" wire:model.blur=\"{$model}\" class=\"input input-bordered w-full\" /></div>",
            };
        }

        return match($field['type']) {
            'number'   => "    <x-fabric::input type=\"number\" label=\"{$label}\" wire:model.blur=\"{$model}\" step=\"1\" />",
            'boolean'  => "    <x-fabric::toggle label=\"{$label}\" wire:model.blur=\"{$model}\" />",
            'textarea' => "    <x-fabric::textarea label=\"{$label}\" wire:model.blur=\"{$model}\" />",
            'relationship' => $this->compileRelationshipSelect($field, $model),
            'enum'     => $this->compileEnumField($field, $model),
            default    => "    <x-fabric::input label=\"{$label}\" wire:model.blur=\"{$model}\" />",
        };
    }

    /**
     * Compile a field for a PHP Enum.
     */
    protected function compileEnumField(array $field, ?string $wireModel = null): string
    {
        $name = $field['name'];
        $model = $wireModel ?? "form.{$name}";
        $label = Str::headline($name);
        $enumClass = $field['enum_class'];
        $theme = \config('fabric.theme', 'tailwind');
        
        if ($theme === 'daisyui') {
            return "
    <fieldset class=\"fieldset\">
        <legend class=\"fieldset-legend\">{$label}</legend>
        <div class=\"flex flex-wrap gap-4\">
            @foreach({$enumClass}::cases() as \$case)
                <label class=\"label cursor-pointer gap-2\">
                    <input type=\"radio\" 
                           wire:model.blur=\"{$model}\" 
                           value=\"{{ \$case instanceof \BackedEnum ? \$case->value : \$case->name }}\" 
                           class=\"radio radio-primary\" />
                    <span class=\"label-text\">
                        {{ method_exists(\$case, 'getLabel') ? \$case->getLabel() : \Illuminate\Support\Str::headline(\$case->name) }}
                    </span>
                </label>
            @endforeach
        </div>
    </fieldset>";
        }

        return "
    <div class=\"space-y-2\">
        <label class=\"text-sm font-medium text-gray-700\">{$label}</label>
        <div class=\"flex flex-wrap gap-4\">
            @foreach({$enumClass}::cases() as \$case)
                <label class=\"inline-flex items-center\">
                    <input type=\"radio\" 
                           wire:model.blur=\"{$model}\" 
                           value=\"{{ \$case instanceof \BackedEnum ? \$case->value : \$case->name }}\" 
                           class=\"text-{{ PRIMARY }} focus:ring-{{ PRIMARY }}\">
                    <span class=\"ml-2 text-sm text-gray-600\">
                        {{ method_exists(\$case, 'getLabel') ? \$case->getLabel() : \Illuminate\Support\Str::headline(\$case->name) }}
                    </span>
                </label>
            @endforeach
        </div>
    </div>";
    }

    /**
     * Compile a select field for a relationship.
     */
    protected function compileRelationshipSelect(array $field, string $model): string
    {
        $rel = $field['relationship'];
        $label = Str::headline($field['name']);
        $modelVar = Str::plural(Str::lower($rel['model']));
        
        return "
    <div class=\"flex items-end gap-2\">
        <div class=\"flex-1\">
            <x-fabric::select label=\"{$label}\" wire:model.blur=\"{$model}\">
                <option value=\"\">Select {$rel['model']}</option>
                @foreach(\${$modelVar} as \$item)
                    <option value=\"{{ \$item->{$rel['column']} }}\">{{ \$item->{$rel['label']} }}</option>
                @endforeach
            </x-fabric::select>
        </div>
        <button type=\"button\" 
                wire:click=\"\$dispatch('openModal', { component: '{{ VIEW_PATH_PREFIX }}.{$rel['slug']}.editor' })\"
                class=\"p-2 mb-1 bg-gray-50 border border-gray-200 rounded-md hover:bg-gray-100 transition\">
            <svg class=\"w-5 h-5 text-gray-500\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M12 6v6m0 0v6m0-6h6m-6 0H6\"/></svg>
        </button>
    </div>";
    }

    protected function compileTableColumns(array $fields): string
    {
        $output = "";
        $theme = \config('fabric.theme', 'tailwind');

        foreach ($fields as $name => $field) {
            $label = Str::headline($name);
            
            if ($field['sortable']) {
                if ($theme === 'daisyui') {
                    $output .= "                <th wire:click=\"sortBy('{$name}')\" class=\"cursor-pointer hover:bg-base-200 transition\">\n";
                    $output .= "                    <div class=\"flex items-center gap-2\">\n";
                    $output .= "                        {$label}\n";
                    $output .= "                        <svg class=\"h-4 w-4 opacity-50\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M8 9l4-4 4 4m0 6l-4 4-4-4\" /></svg>\n";
                    $output .= "                    </div>\n";
                    $output .= "                </th>\n";
                } else {
                    $output .= "                <th class=\"px-6 py-3 text-left\">\n";
                    $output .= "                    <button wire:click=\"sortBy('{$name}')\" class=\"group inline-flex items-center text-xs font-medium text-gray-500 uppercase tracking-wider\">\n";
                    $output .= "                        {$label}\n";
                    $output .= "                        <span class=\"ml-2 flex-none rounded text-gray-400 group-hover:bg-gray-200\">\n";
                    $output .= "                            <svg class=\"h-4 w-4\" fill=\"none\" viewBox=\"0 0 24 24\" stroke-width=\"1.5\" stroke=\"currentColor\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" d=\"M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9\" /></svg>\n";
                    $output .= "                        </span>\n";
                    $output .= "                    </button>\n";
                    $output .= "                </th>\n";
                }
            } else {
                $output .= "                <th class=\"" . ($theme === 'daisyui' ? '' : 'px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider') . "\">{$label}</th>\n";
            }
        }
        return $this->compileThemeColors($output);
    }

    /**
     * Compile actions for the table header (e.g. Export, Add).
     */
    protected function compileTableHeaderActions(array $data): string
    {
        $output = "";
        $model = \class_basename($data['model']);
        $namespace = $this->getNamespace($data);
        $permission = $data['ecosystem']['permission'] ?? false;
        $excel = $data['ecosystem']['excel'] ?? false;
        $viewPath = $this->getViewPath($data);

        if ($excel) {
            $output .= "
            <button wire:click=\"export\" class=\"inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-{{ PRIMARY }} focus:ring-offset-2 transition\">
                Export
            </button>";
        }

        $componentName = $this->getLivewireComponentName($data);
        $addButton = "
            <button wire:click=\"\$dispatch('openModal', { component: '{$componentName}' })\" class=\"inline-flex items-center px-4 py-2 bg-{{ PRIMARY }} border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-{{ PRIMARY }} focus:bg-{{ PRIMARY }} focus:outline-none focus:ring-2 focus:ring-{{ PRIMARY }} focus:ring-offset-2 transition\">
                Add {$model}
            </button>";

        if ($permission) {
            $slug = Str::slug($model);
            $output .= "\n            @can('create-{$slug}')\n                {$addButton}\n            @endcan";
        } else {
            $output .= "\n            {$addButton}";
        }

        return $this->compileThemeColors($output);
    }

    /**
     * Compile actions for each table row (e.g. Edit, Delete).
     */
    protected function compileTableRowActions(array $data): string
    {
        $model = \class_basename($data['model']);
        $permission = $data['ecosystem']['permission'] ?? false;
        $viewPath = $this->getViewPath($data);
        $namespace = $this->getNamespace($data);
        $slug = Str::slug($model);

        $componentName = $this->getLivewireComponentName($data);
        $editButton = "<button wire:click=\"\$dispatch('openModal', { component: '{$componentName}', arguments: { record: {{ \$row->id }} } })\" class=\"text-{{ PRIMARY }} hover:text-indigo-900\">Edit</button>";

        $output = "";

        // Impersonation
        if ($data['ecosystem']['impersonate'] ?? false) {
             if (Str::contains(Str::lower($model), 'user')) {
                 $output .= "
            @canImpersonate
                <a href=\"{{ route('impersonate', \$row->id) }}\" class=\"text-gray-600 hover:text-gray-900\">Impersonate</a>
            @endcanImpersonate";
             }
        }

        // Soft Deletes (Restore)
        if ($data['ecosystem']['soft_deletes'] ?? false) {
            $output .= "
            @if(\$row->trashed())
                <button wire:click=\"restore({{ \$row->id }})\" class=\"text-green-600 hover:text-green-900\">Restore</button>
            @endif";
        }

        if ($permission) {
            $output .= "
            @can('update-{$slug}')
                {$editButton}
            @endcan";
            return $this->compileThemeColors($output);
        }

        $output .= " " . $editButton;

        return $this->compileThemeColors($output);
    }

    protected function compileValidationRules(array $fields): string
    {
        $rules = [];
        foreach ($fields as $name => $field) {
            if ($field['fillable']) {
                $rules["form.{$name}"] = $field['validation'];
            }
        }
        return var_export($rules, true);
    }

    /**
     * Compile public properties for related models in Livewire classes.
     */
    public function compileRelationshipProperties(array $relationships): string
    {
        $output = "";
        
        // BelongsTo properties
        foreach ($relationships['belongs_to'] ?? [] as $rel) {
            $modelVar = Str::plural(Str::lower(\class_basename($rel['model'])));
            $output .= "    public \$" . $modelVar . " = [];\n";
        }

        // ManyToMany properties (IDs of selected items)
        foreach ($relationships['many_to_many'] ?? [] as $rel) {
            $modelVar = Str::plural(Str::lower(\class_basename($rel['model'])));
            $output .= "    public \$" . $modelVar . " = [];\n";
            $output .= "    public \$selected" . Str::studly($modelVar) . " = [];\n";
        }

        return $output;
    }

    /**
     * Compile fetching logic for related models in mount().
     */
    public function compileRelationshipFetching(array $relationships): string
    {
        $output = "";
        
        // Fetch BelongsTo data
        foreach ($relationships['belongs_to'] ?? [] as $rel) {
            $modelVar = Str::plural(Str::lower(\class_basename($rel['model'])));
            $modelClass = Str::startsWith($rel['model'], 'App\\') ? "\\" . $rel['model'] : "\\App\\Models\\" . $rel['model'];
            $output .= "        \$this->" . $modelVar . " = " . $modelClass . "::all();\n";
        }

        // Fetch ManyToMany data & current selections
        foreach ($relationships['many_to_many'] ?? [] as $rel) {
            $modelVar = Str::plural(Str::lower(\class_basename($rel['model'])));
            $modelClass = Str::startsWith($rel['model'], 'App\\') ? "\\" . $rel['model'] : "\\App\\Models\\" . $rel['model'];
            $output .= "        \$this->" . $modelVar . " = " . $modelClass . "::all();\n";
            $output .= "        if (\$this->form->exists) {\n";
            $output .= "            \$this->selected" . Str::studly($modelVar) . " = \$this->form->" . Str::camel($modelVar) . "->pluck('id')->toArray();\n";
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
     * Compile a timeline for Spatie Activity Log.
     */
    protected function compileShowActivityLog(array $data): string
    {
        if (!($data['ecosystem']['activity'] ?? false)) {
            return "";
        }

        return "
                <div class=\"px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 border-t\">
                    <dt class=\"text-sm font-medium text-gray-900\">Activity History</dt>
                    <dd class=\"mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0\">
                        <ul role=\"list\" class=\"space-y-6\">
                            @foreach(\$record->activities()->latest()->take(10)->get() as \$activity)
                                <li class=\"relative flex gap-x-4\">
                                    <div class=\"absolute left-0 top-0 flex w-6 justify-center -bottom-6\">
                                        <div class=\"w-px bg-gray-200\"></div>
                                    </div>
                                    <div class=\"relative flex h-6 w-6 flex-none items-center justify-center bg-white\">
                                        <div class=\"h-1.5 w-1.5 rounded-full bg-gray-100 ring-1 ring-gray-300\"></div>
                                    </div>
                                    <p class=\"flex-auto py-0.5 text-xs leading-5 text-gray-500\">
                                        <span class=\"font-medium text-gray-900\">{{ \$activity->causer?->name ?? 'System' }}</span> 
                                        {{ \$activity->description }} 
                                        <span class=\"whitespace-nowrap\">{{ \$activity->created_at->diffForHumans() }}</span>
                                    </p>
                                </li>
                            @endforeach
                        </ul>
                    </dd>
                </div>";
    }

    /**
     * Compile filters for the table (e.g. Show Trashed).
     */
    protected function compileTableFilters(array $data): string
    {
        if (!($data['ecosystem']['soft_deletes'] ?? false)) {
            return "";
        }

        return "
            <div class=\"flex items-center gap-2\">
                <label class=\"text-xs font-bold text-gray-500 uppercase\">Show Trashed</label>
                <input type=\"checkbox\" wire:model.live=\"showTrashed\" class=\"rounded border-gray-300 text-{{ PRIMARY }} shadow-sm focus:ring-{{ PRIMARY }}\">
            </div>";
    }

    /**
     * Compile PHP properties for table filters.
     */
    protected function compileTableFilterProperties(array $data): string
    {
        $output = "";
        if ($data['ecosystem']['soft_deletes'] ?? false) {
            $output .= "    public \$showTrashed = false;\n";
        }
        return $output;
    }

    /**
     * Compile Eloquent query logic for filters.
     */
    protected function compileTableFilterLogic(array $data): string
    {
        $output = "";
        
        // Multi-Tenant Shield
        if ($data['tenant'] ?? false) {
            $tenantKey = \config('fabric.tenant_key', 'team_id');
            $output .= "            ->where('{$tenantKey}', auth()->user()->{$tenantKey})\n";
        }

        // Soft-Delete Tri-State Filter
        if ($data['soft_deletes'] ?? false) {
            $output .= "            ->when(\$this->filters['trash'] ?? null, function (\$q, \$trash) {\n";
            $output .= "                if (\$trash === 'with') \$q->withTrashed();\n";
            $output .= "                if (\$trash === 'only') \$q->onlyTrashed();\n";
            $output .= "            })\n";
        }

        foreach ($data['relationships']['belongs_to'] ?? [] as $column => $rel) {
            $output .= "            ->when(\$this->filters['{$column}'] ?? null, fn(\$q, \$val) => \$q->where('{$column}', \$val))\n";
        }

        return $output;
    }

    /**
     * Compile PHP methods for table actions.
     */
    protected function compileTableActionMethods(array $data): string
    {
        $output = "";
        $model = \class_basename($data['model']);

        // Soft Deletes (Restore & Force Delete)
        if ($data['soft_deletes'] ?? false) {
            $output .= "
    public function restore(\$id)
    {
        \$this->authorize('restore', {$model}::class);
        {$model}::withTrashed()->find(\$id)->restore();
        \$this->dispatch('notify', message: __('Record restored successfully.'));
    }

    public function forceDelete(\$id)
    {
        \$this->authorize('forceDelete', {$model}::class);
        {$model}::withTrashed()->find(\$id)->forceDelete();
        \$this->dispatch('notify', message: __('Record permanently deleted.'));
    }\n";
        }

        // Excel Export
        if ($data['ecosystem']['excel'] ?? false) {
            $output .= "
    public function export()
    {
        \$this->authorize('viewAny', {$model}::class);
        return \\Maatwebsite\\LaravelExcel\\Facades\\Excel::download(
            new \\App\\Exports\\{$model}Export, 
            '{$model}-' . now()->format('Y-m-d') . '.xlsx'
        );
    }\n";
        }

        // Standard Deletion
        $output .= "
    public function deleteSelected()
    {
        // \$this->authorize('deleteAny', {$model}::class);
        {$model}::whereIn('id', \$this->selected)->delete();
        \$this->selected = [];
        \$this->dispatch('notify', message: __('Selected records deleted.'));
    }

    public function delete(\$id)
    {
        // \$this->authorize('delete', {$model}::class);
        {$model}::find(\$id)->delete();
        \$this->dispatch('notify', message: __('Record deleted successfully.'));
    }\n";

        return $output;
    }

    /**
     * Compile reactive hooks for Livewire fields.
     */
    protected function compileFieldReactiveHooks(array $fields): string
    {
        $output = "";
        foreach ($fields as $name => $field) {
            if (!$field['fillable']) continue;

            $methodName = Str::studly(str_replace('.', '_', $name));
            $output .= "
    public function updatedForm{$methodName}(\$value)
    {
        // Add dependent field logic here
    }\n";
        }
        return $output;
    }

    /**
     * Get a suitable field name for testing purposes.
     */
    protected function getTestField(array $fields): string
    {
        $candidates = ['name', 'title', 'label', 'email', 'subject', 'slug'];
        
        foreach ($candidates as $candidate) {
            if (isset($fields[$candidate])) return $candidate;
        }

        // Fallback to first searchable string field
        foreach ($fields as $name => $field) {
            if ($field['searchable']) return $name;
        }

        return 'id'; // Absolute fallback
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

    /**
     * Compile explicit table row columns with relationship resolution.
     */
    protected function compileTableRows(array $data): string
    {
        $output = "";
        $relationships = $data['relationships']['belongs_to'] ?? [];

        foreach ($data['fields'] as $name => $field) {
            // Handle Relationships
            if ($field['type'] === 'relationship' && isset($relationships[$name])) {
                $rel = $relationships[$name];
                $relationMethod = Str::camel(Str::replaceLast('_id', '', $name));
                $output .= "                        <td class=\"px-6 py-4 whitespace-nowrap text-sm text-gray-900\">\n";
                $output .= "                            {{ \$row->{$relationMethod}?->{$rel['label']} ?? '-' }}\n";
                $output .= "                        </td>\n";
                continue;
            }

            // Handle Boolean Badges
            if ($field['type'] === 'boolean') {
                $output .= "                        <td class=\"px-6 py-4 whitespace-nowrap text-sm\">\n";
                $output .= "                            <span class=\"px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ \$row->{$name} ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}\">\n";
                $output .= "                                {{ \$row->{$name} ? __('Yes') : __('No') }}\n";
                $output .= "                            </span>\n";
                $output .= "                        </td>\n";
                continue;
            }

            // Handle Dates
            if (\in_array($field['type'], ['date', 'datetime', 'timestamp'])) {
                $format = $field['type'] === 'date' ? 'Y-m-d' : 'Y-m-d H:i';
                $output .= "                        <td class=\"px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-mono\">\n";
                $output .= "                            {{ \$row->{$name}?->format('{$format}') ?? '-' }}\n";
                $output .= "                        </td>\n";
                continue;
            }

            // Handle Arrays/JSON
            if ($field['type'] === 'array' || $field['type'] === 'json') {
                $output .= "                        <td class=\"px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-mono\">{{ is_array(\$row->{$name}) ? json_encode(\$row->{$name}) : \$row->{$name} }}</td>\n";
                continue;
            }

            // Default Column
            $output .= "                        <td class=\"px-6 py-4 whitespace-nowrap text-sm text-gray-900\">{{ \$row->{$name} }}</td>\n";
        }

        return $output;
    }

    /**
     * Compile a Trash filter for models with SoftDeletes.
     */
    protected function compileTrashFilter(array $data): string
    {
        if (!($data['soft_deletes'] ?? false)) {
            return "";
        }

        return "
            <x-fabric::select wire:model.live=\"filters.trash\" class=\"w-40\">
                <option value=\"\">" . __('Active Records') . "</option>
                <option value=\"with\">" . __('All Records') . "</option>
                <option value=\"only\">" . __('Trash Only') . "</option>
            </x-fabric::select>";
    }

    /**
     * Compile explicit show fields with relationship resolution.
     */
    protected function compileShowFields(array $data): string
    {
        $output = "";
        $relationships = $data['relationships']['belongs_to'] ?? [];

        foreach ($data['fields'] as $name => $field) {
            $label = Str::headline($name);
            $isSensitive = \in_array(\strtolower($name), ['email', 'phone', 'password', 'secret', 'ssn', 'credit_card', 'salary', 'salary_amount']);

            $output .= "            <div class=\"px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6\">\n";
            $output .= "                <dt class=\"text-sm font-medium text-gray-900\">{{ __('{$label}') }}</dt>\n";
            $output .= "                <dd class=\"mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0\"" . ($isSensitive ? ' x-data="{ revealed: false }"' : '') . ">\n";

            // Handle Relationships
            if ($field['type'] === 'relationship' && isset($relationships[$name])) {
                $rel = $relationships[$name];
                $relationMethod = Str::camel(Str::replaceLast('_id', '', $name));
                $output .= "                    {{ \$record->{$relationMethod}?->{$rel['label']} ?? '—' }}\n";
            } 
            // Handle Media
            elseif ($field['is_media'] ?? false) {
                $output .= "                    <img src=\"{{ \$record->getFirstMediaUrl('{$name}') }}\" class=\"h-20 w-20 object-cover rounded-lg shadow-sm\">\n";
            }
            // Handle Dates
            elseif (\in_array($field['type'], ['date', 'datetime', 'timestamp'])) {
                $format = $field['type'] === 'date' ? 'Y-m-d' : 'Y-m-d H:i';
                $output .= "                    <span class=\"font-mono text-gray-500\">{{ \$record->{$name}?->format('{$format}') ?? '—' }}</span>\n";
            }
            // Default
            else {
                if ($isSensitive) {
                    $output .= "                    <span x-show=\"!revealed\" class=\"blur-sm select-none cursor-pointer text-gray-300\" @click=\"revealed = true\">••••••••</span>\n";
                    $output .= "                    <span x-show=\"revealed\" x-cloak>{{ \$record->{$name} ?: '—' }}</span>\n";
                } else {
                    $output .= "                    {{ \$record->{$name} ?: '—' }}\n";
                }
            }

            $output .= "                </dd>\n";
            $output .= "            </div>\n";
        }

        return $output;
    }

    /**
     * Compile actions for models with SoftDeletes (e.g. restore).
     */
    protected function compileSoftDeleteActions(array $data): string
    {
        // Currently handled in compileTableActionMethods for consistency.
        // Returning empty string to avoid "undefined method" errors.
        return "";
    }
}
