<?php

namespace CLCBWS\Fabric\Commands;

use CLCBWS\Fabric\Engines\Loom;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
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

    public function handle(Loom $loom)
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

    protected function takeSnapshot(Loom $loom)
    {
        $this->components->info("Taking database schema snapshot...");
        
        $tables = \Illuminate\Support\Facades\DB::connection()->getDoctrineSchemaManager()->listTableNames();
        $snapshot = [];

        foreach ($tables as $table) {
            $snapshot[$table] = \Illuminate\Support\Facades\DB::connection()->getDoctrineSchemaManager()->listTableColumns($table);
        }

        File::put($this->snapshotPath, \json_encode($snapshot, JSON_PRETTY_PRINT));
        $this->info("Snapshot saved to storage/app/fabric_schema.json");
    }

    protected function detectDrift(Loom $loom)
    {
        $this->components->info("Checking for schema drift...");
        
        $oldSchema = \json_decode(File::get($this->snapshotPath), true);
        $newTables = \Illuminate\Support\Facades\DB::connection()->getDoctrineSchemaManager()->listTableNames();
        
        $driftDetected = false;

        foreach ($oldSchema as $table => $columns) {
            if (!\in_array($table, $newTables)) {
                $this->error("Table REMOVED: {$table}");
                $driftDetected = true;
                continue;
            }

            $currentColumns = \Illuminate\Support\Facades\DB::connection()->getDoctrineSchemaManager()->listTableColumns($table);
            
            // Check for missing/new columns
            foreach ($columns as $colName => $colData) {
                if (!isset($currentColumns[$colName])) {
                    $this->warn("Column REMOVED in {$table}: {$colName}");
                    $driftDetected = true;
                }
            }

            foreach ($currentColumns as $colName => $colData) {
                if (!isset($columns[$colName])) {
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

    protected function generateFixMigration(string $table, string $column, string $action)
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
