<?php

namespace CLCBWS\Fabric\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ReadyCommand extends Command
{
    protected $signature = 'fabric:ready';
    protected $description = 'Pre-flight check to verify production readiness';

    public function handle()
    {
        $this->components->info("Fabric Deployment Safety: Auditing Environment...");

        $checks = [
            'App Debug' => [
                'check' => !config('app.debug'),
                'fail' => 'APP_DEBUG is TRUE. Disable it for production!',
            ],
            'Config Cache' => [
                'check' => app()->configurationIsCached(),
                'fail' => 'Config is not cached. Run php artisan config:cache.',
            ],
            'Route Cache' => [
                'check' => app()->routesAreCached(),
                'fail' => 'Routes are not cached. Run php artisan route:cache.',
            ],
            'Storage Link' => [
                'check' => File::exists(public_path('storage')),
                'fail' => 'Storage symlink is missing. Run php artisan storage:link.',
            ],
            'Secure Permissions' => [
                'check' => is_writable(storage_path()) && is_writable(base_path('bootstrap/cache')),
                'fail' => 'Storage/Cache directories are not writable.',
            ],
        ];

        $passed = 0;
        foreach ($checks as $label => $check) {
            if ($check['check']) {
                $this->components->twoColumnDetail($label, '<fg=green>✓ Ready</>');
                $passed++;
            } else {
                $this->components->twoColumnDetail($label, '<fg=red>✗ FAILED</>');
                $this->warn("  ↳ " . $check['fail']);
            }
        }

        $this->newLine();
        if ($passed === count($checks)) {
            $this->info("✨ Your environment is PRODUCTION-READY. Forge ahead!");
        } else {
            $this->error("🚨 Critical issues found. Do not deploy until fixed.");
        }
    }
}
