<?php

declare(strict_types=1);

namespace CLCBWS\Fabric\Services\Concerns;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


trait CompilesForms
{
    /**
     * Compile form field stubs based on column types.
     */
    public function traitCompileFormFields(array $data): string
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
            $modelName = \class_basename($rel['model']);
            $modelVar = Str::plural(Str::lower($modelName));
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
        $modelName = \class_basename($rel['model']);
        $modelVar = Str::plural(Str::lower($modelName));
        
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
}
