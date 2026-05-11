<?php

declare(strict_types=1);

namespace CLCBWS\Fabric\Engines;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use CLCBWS\Fabric\Contracts\LoomContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use ReflectionClass;

class Loom implements LoomContract
{
    /**
     * Cache of the database schema to avoid redundant full-table scans.
     */
    protected static array $schemaCache = [];

    /**
     * Introspect a model and return its UI data contract.
     */
    public function introspect(string $modelClass): array
    {
        if (!\class_exists($modelClass)) {
            throw new \Exception("Model class {$modelClass} not found.");
        }

        $model = new $modelClass;
        $tableName = $model->getTable();
        $columns = Schema::getColumnListing($tableName);
        
        $ecosystem = $this->detectEcosystem($model);
        
        $contract = [
            'model' => $modelClass,
            'table' => $tableName,
            'fields' => [],
            'relationships' => $this->getRelationships($tableName),
            'ecosystem' => $ecosystem,
            'soft_deletes' => $ecosystem['soft_deletes'] ?? false,
        ];

        foreach ($columns as $column) {
            if ($this->shouldIgnore($column)) {
                continue;
            }

            $field = $this->mapColumn($tableName, $column, $model);
            
            // Overwrite type if it's a relationship
            if (isset($contract['relationships']['belongs_to'][$column])) {
                $field['type'] = 'relationship';
                $field['relationship'] = $contract['relationships']['belongs_to'][$column];
            }

            $contract['fields'][$column] = $field;
        }

        return $contract;
    }

    /**
     * Detect integrated packages and traits.
     */
    protected function detectEcosystem(Model $model): array
    {
        $traits = \class_uses_recursive($model);

        return [
            'media'      => \in_array('Spatie\MediaLibrary\HasMedia', $traits),
            'permission' => \class_exists('Spatie\Permission\PermissionServiceProvider') && (\in_array('Spatie\Permission\Traits\HasRoles', $traits) || \in_array('Spatie\Permission\Traits\HasPermissions', $traits)),
            'activity'   => \in_array('Spatie\Activitylog\Traits\LogsActivity', $traits) || \in_array('Spatie\Activitylog\Models\Concerns\LogsActivity', $traits),
            'scout'      => \in_array('Laravel\Scout\Searchable', $traits),
            'excel'      => \class_exists('Maatwebsite\LaravelExcel\ExcelServiceProvider'),
            'tags'       => \in_array('Spatie\Tags\HasTags', $traits),
            'translatable' => \in_array('Spatie\Translatable\HasTranslations', $traits),
            'sluggable'  => \in_array('Spatie\Sluggable\HasSlug', $traits),
            'soft_deletes' => \in_array('Illuminate\Database\Eloquent\SoftDeletes', $traits),
            'impersonate' => \class_exists('Lab404\Impersonate\ImpersonateServiceProvider'),
            'factory'     => \in_array('Illuminate\Database\Eloquent\Factories\HasFactory', $traits),
        ];
    }

    /**
     * Check if a column should be ignored based on config.
     */
    protected function shouldIgnore(string $column): bool
    {
        return in_array($column, \config('fabric.ignore', []));
    }

    /**
     * Map a database column to a Fabric field definition.
     */
    protected function mapColumn(string $table, string $column, Model $model): array
    {
        $type = Schema::getColumnType($table, $column);
        $isFillable = $model->isFillable($column);
        $enumClass = $this->getEnumClass($model, $column);
        
        // Detect JSON/Array
        $isJson = \in_array($type, ['json', 'array']) || Str::contains($type, 'json') || \in_array($model->getCasts()[$column] ?? '', ['json', 'array', 'object', 'collection']);
        
        // Detect Media Fields (Spatie)
        $isMedia = false;
        if (\in_array('Spatie\MediaLibrary\HasMedia', \class_uses_recursive($model))) {
             // Basic heuristic: if column name contains 'image', 'file', 'avatar', 'logo'
             if (Str::contains($column, ['image', 'file', 'avatar', 'logo', 'document', 'pdf', 'attachment'])) {
                 $isMedia = true;
             }
        }
        
        return [
            'name' => $column,
            'type' => $isMedia ? 'media' : ($isJson ? 'json' : ($enumClass ? 'enum' : $this->normalizeType($type, $column))),
            'enum_class' => $enumClass,
            'database_type' => $type,
            'is_json' => $isJson ?? false,
            'fillable' => $isFillable,
            'sortable' => $this->isSortable($type, $column),
            'searchable' => $this->isSearchable($type, $column),
            'validation' => $this->deriveValidation($table, $column, $isFillable),
        ];
    }

    /**
     * Check if a column is cast to an Enum and return the class name.
     */
    protected function getEnumClass(Model $model, string $column): ?string
    {
        $casts = $model->getCasts();
        $cast = $casts[$column] ?? null;

        if ($cast && \class_exists($cast) && \enum_exists($cast)) {
            return $cast;
        }

        return null;
    }

    protected function isSortable(string $type, string $column): bool
    {
        // Numbers, dates, and short strings are generally sortable
        return \in_array($type, ['integer', 'bigint', 'datetime', 'date', 'string', 'boolean']);
    }

    protected function isSearchable(string $type, string $column): bool
    {
        // Text and strings are searchable
        return \in_array(\strtolower($type), ['string', 'text', 'email', 'varchar', 'char']);
    }

    /**
     * Normalize database types to Fabric UI types.
     */
    protected function normalizeType(string $type, string $column): string
    {
        if (\str_contains($column, 'email')) return 'email';
        if (\str_contains($column, 'password')) return 'password';
        
        return match ($type) {
            'integer', 'bigint', 'smallint' => 'number',
            'boolean' => 'boolean',
            'datetime', 'timestamp' => 'datetime',
            'date' => 'date',
            'text', 'longtext' => 'textarea',
            'json', 'array' => 'json',
            default => 'text',
        };
    }

    /**
     * Derive basic validation rules from schema.
     */
    protected function deriveValidation(string $table, string $column, bool $isFillable): array
    {
        $rules = [];
        if (!$isFillable) return $rules;

        $columns = Schema::getColumns($table);
        $col = collect($columns)->firstWhere('name', $column);
        
        if (!$col) return $rules;

        // 1. Requirement
        if (!$col['nullable'] && $col['default'] === null) {
            $rules[] = 'required';
        } else {
            $rules[] = 'nullable';
        }

        // 2. Length (heuristic for strings)
        if (Str::contains($col['type'] ?? '', 'varchar')) {
            // Native schema doesn't always expose length easily without DBAL, 
            // but we can try to guess or use 255
            $rules[] = "max:255";
        }

        // 3. Types
        $type = Schema::getColumnType($table, $column);
        if (\in_array($type, ['integer', 'bigint', 'smallint'])) {
            $rules[] = 'integer';
        }
        if ($type === 'boolean') {
            $rules[] = 'boolean';
        }
        if (\str_contains($column, 'email')) {
            $rules[] = 'email';
        }

        // 4. Foreign Key Integrity (exists:table,column)
        $relationships = $this->getRelationships($table);
        if (isset($relationships['belongs_to'][$column])) {
            $rel = $relationships['belongs_to'][$column];
            $existsRule = "exists:{$rel['table']},{$rel['column']}";
            
            // Check if target table has soft deletes
            if (\in_array('deleted_at', Schema::getColumnListing($rel['table']))) {
                $existsRule .= ",deleted_at,NULL";
            }
            
            $rules[] = $existsRule;
        }

        return $rules;
    }

    /**
     * Get all relationships (BelongsTo and HasMany) for the table.
     */
    public function getRelationships(string $table): array
    {
        if (isset(static::$schemaCache[$table])) {
            return static::$schemaCache[$table];
        }

        $relationships = [
            'belongs_to'   => [],
            'has_many'     => [],
            'many_to_many' => [],
        ];

        // 1. Detect BelongsTo (Outgoing Foreign Keys)
        $foreignKeys = Schema::getForeignKeys($table);
        foreach ($foreignKeys as $fk) {
            $relationships['belongs_to'][$fk['columns'][0]] = [
                'table'  => $fk['foreign_table'],
                'column' => $fk['foreign_columns'][0],
                'model'  => $this->resolveModelFromTable($fk['foreign_table']),
                'label'  => $this->guessLabelColumn($fk['foreign_table']),
                'slug'   => Str::kebab(Str::singular($fk['foreign_table'])),
            ];
        }

        // 2. Detect HasMany (Incoming Foreign Keys from other tables)
        $allTables = array_map(fn($t) => str_replace('main.', '', $t), Schema::getTableListing());
        foreach ($allTables as $otherTable) {
            if ($otherTable === $table) continue;

            $otherFks = Schema::getForeignKeys($otherTable);
            foreach ($otherFks as $fk) {
                if ($fk['foreign_table'] === $table) {
                    $relationships['has_many'][$otherTable] = [
                        'table'       => $otherTable,
                        'foreign_key' => $fk['columns'][0],
                        'model'       => $this->resolveModelFromTable($otherTable),
                        'label'       => $this->guessLabelColumn($otherTable),
                        'slug'        => Str::kebab(Str::singular($otherTable)),
                    ];
                }
            }
        }

        // 3. Detect ManyToMany (Pivot Tables)
        foreach ($allTables as $otherTable) {
            $parts = explode('_', $otherTable);
            if (count($parts) === 2 && in_array(Str::plural($parts[0]), $allTables) && in_array(Str::plural($parts[1]), $allTables)) {
                // Potential pivot table found. Check if it points to the current table.
                if ($parts[0] === Str::singular($table) || $parts[1] === Str::singular($table)) {
                    $otherPart = ($parts[0] === Str::singular($table)) ? $parts[1] : $parts[0];
                    $otherTableReal = Str::plural($otherPart);
                    
                    $relationships['many_to_many'][$otherTable] = [
                        'pivot_table' => $otherTable,
                        'model'       => $this->resolveModelFromTable($otherTableReal),
                        'table'       => $otherTableReal,
                        'label'       => $this->guessLabelColumn($otherTableReal),
                        'slug'        => Str::kebab($otherPart),
                    ];
                }
            }
        }

        return static::$schemaCache[$table] = $relationships;
    }

    /**
     * Resolve the FQCN of a model from its table name.
     */
    protected function resolveModelFromTable(string $table): string
    {
        $modelName = Str::studly(Str::singular($table));
        
        // Search in common locations for Slim Skeletons
        $locations = [
            "App\\Models\\{$modelName}",
            "App\\{$modelName}",
            "App\\Domain\\Models\\{$modelName}",
        ];

        foreach ($locations as $fqcn) {
            if (class_exists($fqcn)) {
                return $fqcn;
            }
        }

        return "App\\Models\\{$modelName}"; // Fallback
    }

    /**
     * Guess which column should be used as the label for a relationship select.
     */
    protected function guessLabelColumn(string $table): string
    {
        $columns = Schema::getColumnListing($table);
        $search = ['name', 'title', 'label', 'email', 'username'];

        foreach ($search as $candidate) {
            if (in_array($candidate, $columns)) {
                return $candidate;
            }
        }

        return 'id';
    }
}
