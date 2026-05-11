<?php

declare(strict_types=1);

namespace CLCBWS\Fabric\Engines;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Schema;

class Blueprint
{
    /**
     * Generate migration content for a given table.
     */
    public function generate(string $table): string
    {
        $columns = Schema::getColumnListing($table);
        $definitions = [];

        foreach ($columns as $column) {
            $definitions[] = $this->getColumnDefinition($table, $column);
        }

        return $this->buildMigration($table, $definitions);
    }

    /**
     * Map a database column to a Laravel Blueprint method.
     */
    protected function getColumnDefinition(string $table, string $column): string
    {
        $type = Schema::getColumnType($table, $column);
        $details = Schema::getColumns($table);
        
        // Find current column details
        $colDetail = collect($details)->firstWhere('name', $column);
        $isNullable = $colDetail['nullable'] ?? false;
        
        // Skip common timestamp/id if they are handled by methods
        if ($column === 'id') return "\$table->id();";
        if ($column === 'created_at' || $column === 'updated_at') return "";

        // Detect Foreign Keys with Precision
        if (Str::endsWith($column, '_id')) {
            $foreignKeys = Schema::getForeignKeys($table);
            $fk = collect($foreignKeys)->filter(fn($f) => $f['columns'][0] === $column)->first();
            
            if ($fk) {
                $definition = "\$table->foreignId('{$column}')->constrained('{$fk['foreign_table']}')";
            } else {
                $definition = "\$table->foreignId('{$column}')->constrained()";
            }
            
            return $isNullable ? $definition . "->nullable()->cascadeOnDelete();" : $definition . "->cascadeOnDelete();";
        }

        $method = $this->mapTypeToMethod($type);
        $definition = "\$table->{$method}('{$column}')";
        
        if ($isNullable) {
            $definition .= "->nullable()";
        }
        
        return $definition . ";";
    }

    protected function mapTypeToMethod(string $type): string
    {
        return match($type) {
            'integer' => 'integer',
            'bigint'  => 'bigInteger',
            'string'  => 'string',
            'text'    => 'text',
            'boolean' => 'boolean',
            'datetime' => 'dateTime',
            'date'     => 'date',
            'decimal'  => 'decimal',
            default    => 'string',
        };
    }

    protected function buildMigration(string $table, array $definitions): string
    {
        $definitions = array_filter($definitions);
        $body = implode("\n            ", $definitions);

        return <<<EOT
<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('{$table}', function (Blueprint \$table) {
            {$body}
            \$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('{$table}');
    }
};
EOT;
    }
}
