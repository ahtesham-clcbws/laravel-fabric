<?php

namespace CLCBWS\Fabric\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class EnvShieldCommand extends Command
{
    protected $signature = 'fabric:shield';
    protected $description = 'Ensure parity between .env and .env.example to prevent configuration drift';

    public function handle()
    {
        $this->components->info("Checking Environment Parity...");

        $envPath = base_path('.env');
        $examplePath = base_path('.env.example');

        if (!File::exists($envPath) || !File::exists($examplePath)) {
            $this->error("Environment files missing.");
            return;
        }

        $envKeys = $this->getKeys($envPath);
        $exampleKeys = $this->getKeys($examplePath);

        // 1. Check for Production keys in Local
        if (app()->isLocal() && (\config('app.env') === 'production' || \str_contains(File::get($envPath), 'APP_ENV=production'))) {
            $this->components->error("SECURITY ALERT: Local .env is set to PRODUCTION. Please fix immediately.");
        }

        $missing = array_diff($envKeys, $exampleKeys);

        if (empty($missing)) {
            $this->info("✨ Environment parity is perfect. No missing keys in .env.example.");
            return;
        }

        foreach ($missing as $key) {
            $this->warn("Missing key in .env.example: {$key}");
            if ($this->confirm("Add {$key} to .env.example?", true)) {
                File::append($examplePath, "\n{$key}=\n");
                $this->info("Added {$key} to .env.example");
            }
        }
    }

    protected function getKeys(string $path): array
    {
        $content = File::get($path);
        preg_match_all('/^([A-Z_]+)=/m', $content, $matches);
        return $matches[1];
    }
}
