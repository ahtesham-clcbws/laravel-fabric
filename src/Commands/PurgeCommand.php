<?php

declare(strict_types=1);

namespace CLCBWS\Fabric\Commands;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use CLCBWS\Fabric\Engines\Loom;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PurgeCommand extends Command
{
    protected $signature = 'fabric:purge {model} {--days=365} {--anonymize}';
    protected $description = 'Enforce data retention policies by purging or anonymizing old records';

    public function handle(Loom $loom)
    {
        $model = $this->argument('model');
        $days = (int) $this->option('days');
        $modelClass = "App\\Models\\{$model}";

        if (!class_exists($modelClass)) {
            $this->error("Model {$modelClass} not found.");
            return;
        }

        $cutoff = now()->subDays($days);
        $query = $modelClass::where('created_at', '<', $cutoff);
        $count = $query->count();

        if ($count === 0) {
            $this->info("No records found matching the retention policy ({$days} days).");
            return;
        }

        if (!$this->confirm("Are you sure you want to " . ($this->option('anonymize') ? 'anonymize' : 'DELETE') . " {$count} records?", false)) {
            return;
        }

        if ($this->option('anonymize')) {
            $this->components->task("Anonymizing records", function() use ($query) {
                $query->update(['email' => '[DELETED]', 'name' => '[ANONYMOUS]']);
            });
        } else {
            $this->components->task("Purging records", function() use ($query) {
                $query->delete();
            });
        }

        $this->info("✨ Data retention policy enforced successfully.");
    }
}
