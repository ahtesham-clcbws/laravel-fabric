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
        $this->components->info("Initializing Laravel Fabric...");

        // 1. Publish Config
        $this->call('vendor:publish', ['--tag' => 'fabric-config']);

        // 2. Publish Assets
        $this->call('fabric:assets');

        // 3. Setup Routes
        $prefix = $this->option('prefix') ?? \config('fabric.prefix', 'fabric');
        $this->setupRoutes($prefix);

        // 4. Setup Scripts
        $this->setupScripts();

        // 5. Seed Admin User
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
        $this->info("Dashboard Prefix: /{$prefix}");
    }

    protected function setupRoutes(string $prefix): void
    {
        $path = base_path('routes/fabric.php');
        
        $content = "<?php


use Illuminate\Support\Facades\Route;
use App\Livewire\Fabric\Dashboard;
use App\Livewire\Fabric\Lab;
use App\Livewire\Fabric\Omnisearch;

/*
|--------------------------------------------------------------------------
| Fabric Routes (Forged by CLI)
|--------------------------------------------------------------------------
*/

Route::middleware(['web', 'auth'])->prefix('{$prefix}')->group(function () {
    Route::get('/', Dashboard::class)->name('fabric.dashboard');
    Route::get('/lab', Lab::class)->name('fabric.lab');
    
    // Auth Profile
    Route::get('/profile', \\App\\Livewire\\Fabric\\Auth\\Profile::class)->name('fabric.profile');

    // [FABRIC-RESOURCE-ROUTES]
});

// Guest Routes
Route::middleware(['web', 'guest'])->prefix('{$prefix}')->group(function () {
    Route::get('/login', \\App\\Livewire\\Fabric\\Auth\\Login::class)->name('login');
    Route::get('/register', \\App\\Livewire\\Fabric\\Auth\\Register::class)->name('register');
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
                'role' => 'admin', // Shield ACL compatibility
            ]);

            $this->components->twoColumnDetail("User: {$email}", '<fg=green>Created</>');
        } catch (\Exception $e) {
            $this->error("Could not create user: " . $e->getMessage());
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
}
