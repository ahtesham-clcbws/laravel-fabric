<?php

declare(strict_types=1);

namespace CLCBWS\Fabric\Commands;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $signature = 'fabric:install {--prefix=}';
    protected $description = 'Initialize the Laravel Fabric ecosystem and register routes';

    public function handle(): void
    {
        $this->components->info("Initializing Laravel Fabric (v1.0.0-beta)...");

        // 1. Publish Config
        $this->call('vendor:publish', ['--tag' => 'fabric-config']);

        // 2. Publish Core Components & Views
        $this->components->info("Publishing core components and views...");
        $this->call('vendor:publish', ['--tag' => 'fabric-components', '--force' => true]);
        $this->call('vendor:publish', ['--tag' => 'fabric-views', '--force' => true]);
        $this->call('vendor:publish', ['--tag' => 'fabric-layouts', '--force' => true]);

        // 3. Adjust Namespaces
        $this->adjustComponentNamespaces();

        // 4. Publish Common Assets
        $this->call('vendor:publish', ['--tag' => 'fabric-assets', '--force' => true]);
        // 3. Register Documentation Routes
        $this->components->info("Fabric Documentation is now available at: /fabric/docs");

        // 4. Setup Routes
        $prefix = $this->option('prefix') ?? \config('fabric.prefix', 'fabric');
        $this->setupRoutes($prefix);

        // 5. DaisyUI Setup (Optional)
        $this->setupDaisyUI();

        // 5. Seed Admin User (Optional)
        if ($this->confirm('Would you like to forge a Seed Admin user?', true)) {
            $this->createAdminUser();
        }

        // 5. Register in web.php
        $webPath = base_path('routes/web.php');
        if (File::exists($webPath)) {
            $webContent = File::get($webPath);
            if (!str_contains($webContent, "require __DIR__.'/fabric.php'")) {
                File::append($webPath, "\nrequire __DIR__.'/fabric.php';\n");
            }
        }

        $this->newLine();
        $this->info("✨ Laravel Fabric has been installed successfully!");
        $prefix = $this->option('prefix') ?? \config('fabric.prefix', 'fabric');
        $this->info("Dashboard Prefix: /{$prefix}");
    }

    protected function setupRoutes(string $prefix): void
    {
        $path = base_path('routes/fabric.php');
        
        $content = "<?php


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Fabric Routes (Forged by CLI)
|--------------------------------------------------------------------------
*/

Route::middleware(['web'])->prefix('{$prefix}')->group(function () {
    Route::get('/', function() { return 'Fabric Dashboard - Run fabric:generate to add resources'; })->name('fabric.dashboard');
    
    // [FABRIC-RESOURCE-ROUTES]
});
";

        File::put($path, $content);
        $this->components->twoColumnDetail("Routes: routes/fabric.php", '<fg=green>Forged</>');
    }

    protected function createAdminUser(): void
    {
        $name = $this->ask('Admin Name', 'Fabric Admin');
        $email = $this->ask('Admin Email', 'admin@example.com');
        $password = $this->secret('Admin Password');

        if (!$password) {
            $password = 'password';
            $this->warn("No password provided. Defaulting to 'password'.");
        }

        try {
            $user = \App\Models\User::create([
                'name' => $name,
                'email' => $email,
                'password' => \Illuminate\Support\Facades\Hash::make($password),
                'role' => 'admin', // Permissions ACL compatibility
            ]);

            $this->components->twoColumnDetail("User: {$email}", '<fg=green>Created</>');
        } catch (\Exception $e) {
            $this->error("Could not create user: " . $e->getMessage());
        }
    }

    protected function setupDaisyUI(): void
    {
        if ($this->isDaisyInstalled()) {
            $this->components->info("DaisyUI is already installed.");
        } else {
            if ($this->confirm("DaisyUI not detected. Would you like to add it to your project?", true)) {
                $this->components->task("Installing DaisyUI...", function () {
                    $this->runProcess(['npm', 'install', '-D', 'daisyui@latest']);
                });
            }
        }

        if ($this->confirm("Would you like to register DaisyUI as a Tailwind v4 plugin?", true)) {
            $this->registerDaisyPlugin();
            $this->components->info("DaisyUI plugin registered in app.css.");
        }
    }

    protected function isDaisyInstalled(): bool
    {
        $packagePath = base_path('package.json');
        if (!File::exists($packagePath)) return false;
        $package = json_decode(File::get($packagePath), true);
        return isset($package['devDependencies']['daisyui']) || isset($package['dependencies']['daisyui']);
    }

    protected function registerDaisyPlugin(): void
    {
        $cssPath = resource_path('css/app.css');
        if (File::exists($cssPath)) {
            $content = File::get($cssPath);
            if (!str_contains($content, '@plugin "daisyui"')) {
                $newContent = str_replace('@import "tailwindcss";', "@import \"tailwindcss\";\n@plugin \"daisyui\";", $content);
                File::put($cssPath, $newContent);
            }
        }
    }

    protected function runProcess(array $command): void
    {
        $process = new \Symfony\Component\Process\Process($command);
        $process->setTimeout(300);
        $process->run();

        if (!$process->isSuccessful()) {
            $this->error("Failed to run: " . implode(' ', $command));
            $this->line($process->getErrorOutput());
        }
    }

    protected function setupScripts(): void
    {
        $path = base_path('composer.json');
        if (!File::exists($path)) return;

        $composer = json_decode(File::get($path), true);
        
        $composer['scripts']['dev'] = [
            "Composer\\Config::disableProcessTimeout",
            "php artisan serve --port=8001 &",
            "npm run dev"
        ];

        File::put($path, json_encode($composer, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        $this->components->twoColumnDetail("Scripts: composer dev", '<fg=green>Injected</>');
    }

    protected function adjustComponentNamespaces(): void
    {
        $dir = app_path('Livewire/Fabric');
        if (!File::isDirectory($dir)) return;

        $files = File::allFiles($dir);
        foreach ($files as $file) {
            $content = File::get($file->getRealPath());
            $content = str_replace(
                'namespace CLCBWS\\Fabric\\Livewire\\Fabric',
                'namespace App\\Livewire\\Fabric',
                $content
            );
            File::put($file->getRealPath(), $content);
        }
    }
}
