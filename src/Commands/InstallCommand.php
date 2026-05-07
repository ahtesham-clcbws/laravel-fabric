<?php

namespace CLCBWS\Fabric\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class InstallCommand extends Command
{
    protected $signature = 'fabric:install {--prefix=}';
    protected $description = 'Initialize the Laravel Fabric ecosystem and register routes';

    public function handle()
    {
        $this->components->info("Initializing Laravel Fabric...");

        // 1. Publish Config
        $this->call('vendor:publish', ['--tag' => 'fabric-config']);

        // 2. Publish Assets
        $this->call('fabric:assets');

        // 3. Setup Routes
        $prefix = $this->option('prefix') ?? \config('fabric.prefix', 'admin');
        $this->setupRoutes($prefix);

        // 4. Seed Admin User
        if ($this->confirm('Would you like to forge a Seed Admin user?', true)) {
            $this->createAdminUser();
        }

        $this->newLine();
        $this->info("✨ Laravel Fabric has been installed successfully!");
        $this->info("Dashboard Prefix: /{$prefix}");
        
        $this->newLine();
        $this->components->warn("IMPORTANT: For Laravel 13, ensure you register the routes in bootstrap/app.php if not using the default web.php.");
        $this->line("Add this to your web.php or a custom routes file:");
        $this->line("Route::middleware('web')->group(base_path('routes/fabric.php'));");
    }

    protected function setupRoutes(string $prefix)
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

    protected function createAdminUser()
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
}
