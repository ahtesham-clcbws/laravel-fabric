<?php

declare(strict_types=1);

namespace CLCBWS\Fabric\Services\Concerns;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


trait CompilesLogic
{
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
        " . ($data['ecosystem']['permission'] ? "\$this->authorize('deleteAny', {$model}::class);" : "// \$this->authorize('deleteAny', {$model}::class);") . "
        {$model}::whereIn('id', \$this->selected)->delete();
        \$this->selected = [];
        \$this->dispatch('notify', message: __('Selected records deleted.'));
    }

    public function delete(\$id)
    {
        " . ($data['ecosystem']['permission'] ? "\$this->authorize('delete', {$model}::class);" : "// \$this->authorize('delete', {$model}::class);") . "
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
    protected function compileSearchColumns(array $fields): string
    {
        $searchable = array_filter($fields, fn($f) => $f['searchable']);
        $names = array_keys($searchable);
        
        if (empty($names)) {
            return "'name'"; // Fallback
        }

        return "'" . implode("', '", $names) . "'";
    }
}
