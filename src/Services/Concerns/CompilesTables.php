<?php

declare(strict_types=1);

namespace CLCBWS\Fabric\Services\Concerns;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


trait CompilesTables
{
    public function traitCompileTableColumns(array $fields): string
    {
        $output = "";
        $theme = \config('fabric.theme', 'tailwind');

        foreach ($fields as $name => $field) {
            $label = Str::headline($name);
            
            if ($field['sortable']) {
                if ($theme === 'daisyui') {
                    $output .= "                @if(\$columnVisibility['{$name}'] ?? true)\n";
                    $output .= "                <th wire:click=\"sortBy('{$name}')\" class=\"cursor-pointer hover:bg-base-200 transition\">\n";
                    $output .= "                    <div class=\"flex items-center gap-2\">\n";
                    $output .= "                        {$label}\n";
                    $output .= "                        <svg class=\"h-4 w-4 opacity-50\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M8 9l4-4 4 4m0 6l-4 4-4-4\" /></svg>\n";
                    $output .= "                    </div>\n";
                    $output .= "                </th>\n";
                    $output .= "                @endif\n";
                } else {
                    $output .= "                @if(\$columnVisibility['{$name}'] ?? true)\n";
                    $output .= "                <th class=\"" . ($theme === 'daisyui' ? '' : 'px-6 py-3 text-left') . "\">\n";
                    $output .= "                    <button wire:click=\"sortBy('{$name}')\" class=\"group inline-flex items-center text-xs font-medium " . ($theme === 'daisyui' ? '' : 'text-gray-500 uppercase tracking-wider') . "\">\n";
                    $output .= "                        {$label}\n";
                    $output .= "                        <span class=\"ml-2 flex-none rounded " . ($theme === 'daisyui' ? 'opacity-50' : 'text-gray-400 group-hover:bg-gray-200') . "\">\n";
                    $output .= "                            <svg class=\"h-4 w-4\" fill=\"none\" viewBox=\"0 0 24 24\" stroke-width=\"1.5\" stroke=\"currentColor\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" d=\"M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9\" /></svg>\n";
                    $output .= "                        </span>\n";
                    $output .= "                    </button>\n";
                    $output .= "                </th>\n";
                    $output .= "                @endif\n";
                }
            } else {
                $output .= "                @if(\$columnVisibility['{$name}'] ?? true)\n";
                $output .= "                <th class=\"" . ($theme === 'daisyui' ? '' : 'px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider') . "\">{$label}</th>\n";
                $output .= "                @endif\n";
            }
        }
        return $this->compileThemeColors($output);
    }

    /**
     * Compile actions for the table header (e.g. Export, Add).
     */
    public function compileTableHeaderActions(array $data): string
    {
        $output = "";
        $model = \class_basename($data['model']);
        $permission = $data['ecosystem']['permission'] ?? false;
        $excel = $data['ecosystem']['excel'] ?? false;
        $theme = \config('fabric.theme', 'tailwind');

        if ($excel) {
            $output .= "
            <button wire:click=\"export\" class=\"inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-{{ PRIMARY }} focus:ring-offset-2 transition\">
                Export
            </button>";
        }

        $componentName = $this->getLivewireComponentName($data);
        $addButton = "
            <button wire:click=\"\$dispatch('openModal', { component: '{$componentName}' })\" class=\"inline-flex items-center gap-2 px-4 py-2 bg-{{ PRIMARY }} border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-{{ PRIMARY }} focus:ring-offset-2 transition " . ($theme === 'daisyui' ? 'btn btn-primary' : '') . "\">
                <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"h-5 w-5\" viewBox=\"0 0 20 20\" fill=\"currentColor\"><path fill-rule=\"evenodd\" d=\"M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z\" clip-rule=\"evenodd\" /></svg>
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
    public function compileTableRowActions(array $data): string
    {
        $model = \class_basename($data['model']);
        $permission = $data['ecosystem']['permission'] ?? false;
        $slug = Str::slug($model);

        $componentName = $this->getLivewireComponentName($data);
        $editButton = '<button wire:click="$dispatch(\'openModal\', { component: \'' . $componentName . '\', arguments: { record: {{ $row->id }} } })" class="text-{{ PRIMARY }} hover:text-indigo-900">Edit</button>';

        $output = "";

        // Impersonation
        if (false && $data['ecosystem']['impersonate'] ?? false) {
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
                <button wire:click=\"restore({{ \$row->id }})\" class=\"text-success hover:underline\">Restore</button>
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

    /**
     * Compile explicit table row columns with relationship resolution.
     */
    public function compileTableRows(array $data): string
    {
        $output = "";
        $relationships = $data['relationships']['belongs_to'] ?? [];
        $theme = \config('fabric.theme', 'tailwind');

        foreach ($data['fields'] as $name => $field) {
            $output .= "                        @if(\$columnVisibility['{$name}'] ?? true)\n";
            // Handle Relationships
            if ($field['type'] === 'relationship' && isset($relationships[$name])) {
                $rel = $relationships[$name];
                $relationMethod = Str::camel(Str::replaceLast('_id', '', $name));
                $output .= "                        <td class=\"px-6 py-4 whitespace-nowrap text-sm text-gray-900\">\n";
                $output .= "                            {{ \$row->{$relationMethod}?->{$rel['label']} ?? '-' }}\n";
                $output .= "                        </td>\n";
                $output .= "                        @endif\n";
                continue;
            }

            // Handle Boolean Badges
            if ($field['type'] === 'boolean') {
                $output .= "                        <td class=\"px-6 py-4 whitespace-nowrap text-sm\">\n";
                $output .= "                            <span class=\"px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ \$row->{$name} ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}\">\n";
                $output .= "                                {{ \$row->{$name} ? __('Yes') : __('No') }}\n";
                $output .= "                            </span>\n";
                $output .= "                        </td>\n";
                $output .= "                        @endif\n";
                continue;
            }

            // Handle Dates
            if (\in_array($field['type'], ['date', 'datetime', 'timestamp'])) {
                $format = $field['type'] === 'date' ? 'Y-m-d' : 'Y-m-d H:i';
                $output .= "                        <td class=\"px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-mono\">\n";
                $output .= "                            {{ \$row->{$name}?->format('{$format}') ?? '-' }}\n";
                $output .= "                        </td>\n";
                $output .= "                        @endif\n";
                continue;
            }

            // Handle Arrays/JSON
            if ($field['type'] === 'array' || $field['type'] === 'json') {
                $output .= "                        <td class=\"px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-mono\">{{ is_array(\$row->{$name}) ? json_encode(\$row->{$name}) : \$row->{$name} }}</td>\n";
                $output .= "                        @endif\n";
                continue;
            }

            // Default Column
            $output .= "                        <td class=\"" . ($theme === 'daisyui' ? '' : 'px-6 py-4 whitespace-nowrap text-sm text-gray-900') . "\">{{ \$row->{$name} }}</td>\n";
            $output .= "                        @endif\n";
        }

        return $output;
    }

    /**
     * Compile filters for the table (e.g. Show Trashed).
     */
    public function compileTableFilters(array $data): string
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
        
        // Multi-Tenant Security
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
}
