<?php

declare(strict_types=1);

namespace CLCBWS\Fabric\Commands;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class RegisterCommand extends Command
{
    protected $signature = 'fabric:register {--email=}';
    protected $description = 'Register this project with the Fabric Global Registry (Free Beta)';

    public function handle(): void
    {
        $this->components->info('🧬 Fabric Registry: Project Enrollment');

        $uuidPath = base_path('.fabric');
        if (!File::exists($uuidPath)) {
            $this->error('Project Identity (.fabric) not found. Run fabric:install first.');
            return;
        }

        $uuid = File::get($uuidPath);
        $email = $this->option('email') ?? $this->ask('Enter your developer email');
        $projectName = basename(base_path());

        $this->components->task('Enrolling project in Free Beta...', function () use ($uuid, $email, $projectName) {
            $url = config('fabric.registry.url') . '/functions/v1/register';
            $key = config('fabric.registry.key');

            $response = Http::withHeaders([
                'Authorization' => "Bearer {$key}",
                'apikey' => $key,
            ])->post($url, [
                'uuid' => $uuid,
                'email' => $email,
                'projectName' => $projectName,
                'machineId' => php_uname('n'),
            ]);

            if ($response->failed()) {
                throw new \Exception($response->json('error') ?? 'Registry connection failed.');
            }

            // Save the license artifact
            File::put(base_path('.fabric_license'), $response->json('license'));
            
            return true;
        });

        $this->newLine();
        $this->info("✨ Project Registered Successfully!");
        $this->line("Project UUID: <fg=cyan>{$uuid}</>");
        $this->line("Status: <fg=green;options=bold>LEGACY GOLD (Free Forever)</>");
        
        $this->newLine();
        $this->comment("This project is now linked to {$email}. All resources forged here are protected under your Beta license.");
    }
}
