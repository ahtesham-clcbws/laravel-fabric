<?php

declare(strict_types=1);

namespace CLCBWS\Fabric\Commands;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use CLCBWS\Fabric\Engines\Guard;
use Illuminate\Console\Command;

class DoctorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fabric:doctor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Diagnostic tool for environment health and dependency checks';

    /**
     * Execute the console command.
     */
    public function handle(Guard $guard): void
    {
        $this->components->info('🩺 Laravel Fabric: Diagnostic Forge');

        // Check License
        if ($guard->verify()) {
            $this->components->twoColumnDetail('Fabric License', '<fg=green;options=bold>VALID</>');
        } else {
            $this->components->twoColumnDetail('Fabric License', '<fg=red;options=bold>REQUIRED (Commercial/Enterprise)</>');
        }

        // Check PHP Version
        $this->checkPHP();
        $this->checkLaravel();
        $this->checkConfig();
        $this->checkRuntime();
        $this->checkThemes();
        $this->checkFrontend();

        $this->newLine();
        $this->info('Fabric: Doctor is done.');
    }

    protected function checkFrontend(): void
    {
        $theme = config('fabric.theme', 'tailwind');

        if ($theme === 'tailwind') return;

        // Check package.json
        $packageJson = base_path('package.json');
        if (File::exists($packageJson)) {
            $content = json_decode(File::get($packageJson), true);
            $deps = array_merge($content['dependencies'] ?? [], $content['devDependencies'] ?? []);
            
            $required = match($theme) {
                'daisyui' => 'daisyui',
                'preline' => 'preline',
                default => null
            };

            if ($required && !isset($deps[$required])) {
                $this->components->warn("Missing dependency: {$required}. Run: npm install {$required} --save-dev");
            } else {
                $this->components->twoColumnDetail("NPM Dependency [{$required}]", '<fg=green>Found</>');
            }
        }

        // Check tailwind.config.js
        $twConfig = base_path('tailwind.config.js');
        if (File::exists($twConfig)) {
            $content = File::get($twConfig);
            if (!str_contains($content, $theme)) {
                $this->components->warn("Tailwind Plugin [{$theme}] not detected in tailwind.config.js");
            } else {
                $this->components->twoColumnDetail("Tailwind Plugin [{$theme}]", '<fg=green>Registered</>');
            }
        }
    }

    protected function checkPHP(): void
    {
        $version = PHP_VERSION;
        $success = version_compare($version, '8.3.0', '>=');
        
        $status = $success ? '<fg=green>PASSED</>' : '<fg=red>FAILED (Requires 8.3+)</>';
        $this->components->twoColumnDetail('PHP Version (' . $version . ')', $status);
    }

    /**
     * Check Laravel Version.
     */
    protected function checkLaravel(): void
    {
        $version = $this->getLaravel()->version();
        $success = version_compare($version, '13.0.0', '>=');

        $status = $success ? '<fg=green>PASSED</>' : '<fg=red>FAILED (Requires 13.0+)</>';
        $this->components->twoColumnDetail('Laravel Version (' . $version . ')', $status);
    }

    protected function checkConfig(): void
    {
        $exists = File::exists(config_path('fabric.php'));
        $this->components->twoColumnDetail('Config Published', $exists ? '<fg=green>Yes</>' : '<fg=yellow>No (Default used)</>');
    }

    protected function checkRuntime(): void
    {
        $runtime = config('fabric.runtime', 'livewire');
        $this->components->twoColumnDetail('Active Runtime', "<fg=cyan>{$runtime}</>");
        
        if ($runtime === 'livewire') {
            $exists = class_exists(\Livewire\Livewire::class);
            $this->components->twoColumnDetail('Livewire Presence', $exists ? '<fg=green>Pass</>' : '<fg=red>Fail (Required for Livewire runtime)</>');
        }
    }

    protected function checkThemes(): void
    {
        $theme = config('fabric.theme', 'tailwind');
        $this->components->twoColumnDetail('Active Theme', "<fg=cyan>{$theme}</>");
        
        $stubPath = base_path("stubs/fabric/{$theme}");
        if (!File::isDirectory($stubPath)) {
            $stubPath = __DIR__ . "/../../stubs/{$theme}";
        }

        $exists = File::isDirectory($stubPath);
        $this->components->twoColumnDetail('Theme Stubs Presence', $exists ? '<fg=green>Pass</>' : '<fg=red>Fail (Stubs missing)</>');

        // Check Backup Status
        if (class_exists('Spatie\Backup\BackupServiceProvider')) {
            $this->components->twoColumnDetail('Spatie Backup', '<fg=green>Installed</>');
            // We could run backup:list here, but for now just acknowledge
        } else {
            $this->components->twoColumnDetail('Spatie Backup', '<fg=yellow>Not Found (Optional)</>');
        }
    }
}
