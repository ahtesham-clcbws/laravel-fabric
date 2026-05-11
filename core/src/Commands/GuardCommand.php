<?php

declare(strict_types=1);

namespace CLCBWS\Fabric\Commands;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use CLCBWS\Fabric\Engines\Loom;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class GuardCommand extends Command
{
    protected $signature = 'fabric:guard {--snapshot} {--fix}';
    protected $description = 'Monitor database schema drift and detect manual changes';

    protected string $snapshotPath;

    public function __construct()
    {
        parent::__construct();
        $this->snapshotPath = storage_path('app/fabric_schema.json');
    }

    public function handle(Loom $loom): void
    {
        if ($this->option('snapshot')) {
            $this->takeSnapshot($loom);
            return;
        }

        if (!File::exists($this->snapshotPath)) {
            $this->error("No snapshot found. Run 'fabric:guard --snapshot' first.");
            return;
        }

        $this->detectDrift($loom);
    }

    protected function takeSnapshot(Loom $loom): void
    {
        $this->components->info("Taking database schema snapshot...");
        
        $tables = Schema::getTableListing();
        $snapshot = [];

        foreach ($tables as $table) {
            $snapshot[$table] = Schema::getColumns($table);
        }

        File::put($this->snapshotPath, \json_encode($snapshot, JSON_PRETTY_PRINT));
        $this->info("Snapshot saved to storage/app/fabric_schema.json");
    }

    protected function detectDrift(Loom $loom): void
    {
        $this->components->info("Checking for schema drift...");
        
        $oldSchema = \json_decode(File::get($this->snapshotPath), true);
        $newTables = Schema::getTableListing();
        
        $driftDetected = false;

        foreach ($oldSchema as $table => $columns) {
            if (!\in_array($table, $newTables)) {
                $this->error("Table REMOVED: {$table}");
                $driftDetected = true;
                continue;
            }

            $currentColumns = Schema::getColumns($table);
            $currentColumnNames = collect($currentColumns)->pluck('name')->toArray();
            
            // Check for missing/new columns
            foreach ($columns as $col) {
                $colName = $col['name'] ?? null;
                if ($colName && !\in_array($colName, $currentColumnNames)) {
                    $this->warn("Column REMOVED in {$table}: {$colName}");
                    $driftDetected = true;
                }
            }

            foreach ($currentColumns as $col) {
                $colName = $col['name'];
                $oldColumnNames = collect($columns)->pluck('name')->toArray();
                if (!\in_array($colName, $oldColumnNames)) {
                    $this->info("Column ADDED in {$table}: {$colName}");
                    if ($this->option('fix')) {
                        $this->generateFixMigration($table, $colName, 'add');
                    }
                    $driftDetected = true;
                }
            }
        }

        if (!$driftDetected) {
            $this->info("✨ No schema drift detected. Your database is in sync with the snapshot.");
        }
    }

    protected function generateFixMigration(string $table, string $column, string $action): void
    {
        $timestamp = date('Y_m_d_His');
        $filename = "{$timestamp}_fix_drift_{$action}_{$column}_on_{$table}_table.php";
        $path = database_path("migrations/{$filename}");

        $up = $action === 'add' ? "\$table->string('{$column}')->nullable();" : "\$table->dropColumn('{$column}');";
        $down = $action === 'add' ? "\$table->dropColumn('{$column}');" : "\$table->string('{$column}')->nullable();";

        $stub = "<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('{$table}', function (Blueprint \$table) {
            {$up}
        });
    }

    public function down(): void
    {
        Schema::table('{$table}', function (Blueprint \$table) {
            {$down}
        });
    }
};";

        File::put($path, $stub);
        $this->components->twoColumnDetail("Migration: {$filename}", '<fg=green>Generated</>');

        if ($this->confirm("Would you like to run the migration now?", true)) {
            $this->call('migrate');
        }
    }
}
