<?php

declare(strict_types=1);

namespace CLCBWS\Fabric\Commands;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use Illuminate\Console\Command;

class JailCommand extends Command
{
    protected $signature = 'fabric:jail';
    protected $description = 'Identify and purge third-party packages rendered obsolete by Fabric';

    protected array $replacements = [
        'spatie/laravel-activitylog' => 'Light-Audit',
        'maatwebsite/excel'           => 'Atomic CSV',
        'lab404/laravel-impersonate'  => 'Native Impersonation',
        'spatie/laravel-permission'   => 'Shield ACL',
        'spatie/laravel-medialibrary' => 'Lean-Media',
        'spatie/laravel-health'       => 'Health Dashboard',
        'spatie/laravel-backup'       => 'Native Backup (Coming Soon)',
    ];

    public function handle()
    {
        $this->components->info("Fabric Dependency Jail: Auditing Composer Bloat...");

        $composerPath = base_path('composer.json');
        if (!File::exists($composerPath)) {
            $this->error("composer.json not found.");
            return;
        }

        $composer = \json_decode(File::get($composerPath), true);
        $requirements = array_merge($composer['require'] ?? [], $composer['require-dev'] ?? []);

        $found = 0;
        foreach ($this->replacements as $package => $replacement) {
            if (isset($requirements[$package])) {
                $this->warn("REDUNDANT: {$package} is active.");
                $this->line("  ↳ Fabric provides a native '{$replacement}' component that replaces this.");
                $found++;
            }
        }

        $this->newLine();
        if ($found > 0) {
            $this->info("Audit complete. Found {$found} redundant packages.");
            $this->info("Recommendation: Migrate your data to Fabric's native traits and run 'composer remove [package]'.");
        } else {
            $this->info("✨ Your composer.json is lean and clean. No redundant packages detected.");
        }
    }
}
