<?php

declare(strict_types=1);

namespace CLCBWS\Fabric\Commands;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use Illuminate\Console\Command;

class LogCommand extends Command
{
    protected $signature = 'fabric:logs {--clear : Clear the current log file} {--lines=50 : Number of lines to tail}';
    protected $description = 'Surgically explore and manage application logs';

    public function handle()
    {
        $logPath = storage_path('logs/laravel.log');

        if ($this->option('clear')) {
            File::put($logPath, '');
            $this->info("✨ Laravel log cleared.");
            return;
        }

        if (!File::exists($logPath)) {
            $this->error("Log file not found at: {$logPath}");
            return;
        }

        $this->components->info("Fabric Log Explorer: Tailing last {$this->option('lines')} lines...");

        $content = File::get($logPath);
        $lines = explode("\n", $content);
        $tail = array_slice($lines, -$this->option('lines'));

        foreach ($tail as $line) {
            if (empty($line)) continue;

            if (str_contains($line, '.ERROR')) {
                $this->error($line);
            } elseif (str_contains($line, '.WARNING')) {
                $this->warn($line);
            } else {
                $this->line($line);
            }
        }
    }
}
