<?php

namespace CLCBWS\Fabric\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class VacuumCommand extends Command
{
    protected $signature = 'fabric:vacuum {--assets : Only purge orphaned assets} {--db : Only optimize database tables}';
    protected $description = 'Clean up orphaned assets and optimize database performance';

    public function handle()
    {
        $this->components->info("Fabric Vacuum: Initiating System Cleanup...");

        if ($this->option('assets') || !$this->option('db')) {
            $this->purgeAssets();
        }

        if ($this->option('db') || !$this->option('assets')) {
            $this->optimizeDb();
        }

        $this->info("✨ Vacuum complete. Your system is lean and fast.");
    }

    protected function purgeAssets()
    {
        $this->components->task("Purging Orphaned Assets", function() {
            $files = File::allFiles(storage_path('app/public'));
            $purged = 0;

            foreach ($files as $file) {
                $filename = $file->getFilename();
                
                // Simple check: Is this filename mentioned in ANY table in the DB?
                // This is a high-level scan for zero-dependency media management.
                $found = false;
                $tables = DB::select('SHOW TABLES');
                foreach ($tables as $table) {
                    $tableName = array_values((array)$table)[0];
                    if (DB::table($tableName)->whereRaw("CAST(id AS CHAR) LIKE ?", ["%{$filename}%"])->exists()) {
                        $found = true;
                        break;
                    }
                }

                if (!$found) {
                    File::delete($file->getPathname());
                    $purged++;
                }
            }
            return "Purged {$purged} orphaned files.";
        });
    }

    protected function optimizeDb()
    {
        $this->components->task("Optimizing Database Tables", function() {
            $tables = DB::select('SHOW TABLES');
            foreach ($tables as $table) {
                $tableName = array_values((array)$table)[0];
                DB::statement("OPTIMIZE TABLE {$tableName}");
            }
            return "All tables optimized.";
        });
    }
}
