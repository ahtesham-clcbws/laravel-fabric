<?php

namespace CLCBWS\Fabric\Commands;

use Illuminate\Console\Command;

class SnapshotCommand extends Command
{
    protected $signature = 'fabric:snapshot {table}';
    protected $description = 'Capture live database table data into a high-fidelity portable stub';

    public function handle()
    {
        $class = 'App\\Services\\Snapshot\\SnapshotService';
        
        if (!class_exists($class)) {
            $this->error('Snapshot plugin not found. Run: php artisan fabric:plugin snapshot');
            return;
        }

        $table = $this->argument('table');
        
        $this->info("Taking snapshot of table: {$table}...");
        
        $service = new $class();
        $service->take($table);
        
        $this->components->info("Snapshot saved to stubs/fabric/snapshots/{$table}.php");
    }
}
