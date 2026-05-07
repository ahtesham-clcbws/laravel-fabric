<?php

namespace CLCBWS\Fabric\Commands;

use Illuminate\Console\Command;
use CLCBWS\Fabric\Engines\Blueprint;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ReverseMigrationCommand extends Command
{
    protected $signature = 'fabric:reverse {table}';
    protected $description = 'Snapshot a database table into a Laravel migration file';

    public function handle(Blueprint $blueprint)
    {
        $table = $this->argument('table');
        
        $this->components->info("Snapshotting table: {$table}");

        $content = $blueprint->generate($table);
        
        $filename = date('Y_m_d_His') . "_create_{$table}_table.php";
        $path = \database_path("migrations/{$filename}");

        File::put($path, $content);

        $this->components->info("Migration forged: {$path}");
        
        return self::SUCCESS;
    }
}
