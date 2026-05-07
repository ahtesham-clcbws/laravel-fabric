<?php

namespace CLCBWS\Fabric\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use CLCBWS\Fabric\Engines\Fabricator;
use CLCBWS\Fabric\Engines\Guard;

class AuthCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fabric:auth 
                            {--register : Include registration flow}
                            {--profile : Include profile management}
                            {--2fa : Include two-factor authentication}
                            {--sessions : Include browser session management}
                            {--verify : Include email verification}
                            {--force : Overwrite existing files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold a native, theme-aware authentication system';

    /**
     * Execute the console command.
     */
    public function handle(Guard $guard, Fabricator $fabricator)
    {
        $guard->enforce();

        $theme = config('fabric.theme', 'tailwind');
        $this->components->info("Forging Native Auth for theme: [{$theme}]");

        $steps = [
            'Scaffolding Layouts' => 'scaffoldLayouts',
            'Scaffolding Login' => 'scaffoldLogin',
            'Scaffolding Registration' => 'scaffoldRegister',
            'Scaffolding Password Recovery' => 'scaffoldRecovery',
            'Scaffolding Profile' => 'scaffoldProfile',
            'Scaffolding Session Management' => 'scaffoldSessions',
            'Finalizing Routes' => 'scaffoldRoutes',
        ];

        foreach ($steps as $label => $method) {
            if ($this->shouldExecute($method)) {
                $this->components->task($label, fn() => $this->$method($fabricator));
            }
        }

        $this->newLine();
        $this->info("✨ Fabric Auth forged successfully!");
    }

    protected function shouldExecute(string $method): bool
    {
        return match ($method) {
            'scaffoldRegister' => $this->option('register'),
            'scaffoldProfile'  => $this->option('profile'),
            'scaffoldSessions' => $this->option('sessions'),
            default            => true,
        };
    }

    protected function scaffoldLayouts(Fabricator $fabricator)
    {
        $theme = config('fabric.theme', 'tailwind');
        $runtime = config('fabric.runtime', 'livewire');

        // 1. Guest Layout
        $guestSource = __DIR__ . "/../../stubs/{$runtime}/{$theme}/layouts/guest.blade.php.stub";
        $guestTarget = resource_path("views/layouts/guest.blade.php");

        if (File::exists($guestSource)) {
            File::ensureDirectoryExists(dirname($guestTarget));
            File::put($guestTarget, File::get($guestSource));
        }

        // 2. App Layout (Dashboard base)
        $appSource = __DIR__ . "/../../stubs/{$runtime}/{$theme}/layouts/sidebar.blade.php.stub";
        $appTarget = resource_path("views/layouts/app.blade.php");

        if (File::exists($appSource)) {
            File::ensureDirectoryExists(dirname($appTarget));
            File::put($appTarget, File::get($appSource));
        }
    }

    protected function scaffoldLogin(Fabricator $fabricator)
    {
        $theme = config('fabric.theme', 'tailwind');
        $runtime = config('fabric.runtime', 'livewire');

        // 1. Component Logic
        $componentSource = __DIR__ . "/../../stubs/{$runtime}/common/auth/Login.php.stub";
        $componentTarget = app_path("Livewire/Auth/Login.php");

        if (File::exists($componentSource)) {
            $content = File::get($componentSource);
            $content = str_replace(
                ['{{ NAMESPACE }}', '{{ VIEW }}'],
                ['App\\Livewire\\Auth', 'livewire.auth.login'],
                $content
            );
            File::ensureDirectoryExists(dirname($componentTarget));
            File::put($componentTarget, $content);
        }

        // 2. Component View
        $viewSource = __DIR__ . "/../../stubs/{$runtime}/{$theme}/auth/login.blade.php.stub";
        $viewTarget = resource_path("views/livewire/auth/login.blade.php");

        if (File::exists($viewSource)) {
            $content = File::get($viewSource);
            File::ensureDirectoryExists(dirname($viewTarget));
            File::put($viewTarget, $content);
        }
    }

    protected function scaffoldRegister(Fabricator $fabricator)
    {
        $theme = config('fabric.theme', 'tailwind');
        $runtime = config('fabric.runtime', 'livewire');

        // 1. Component Logic
        $componentSource = __DIR__ . "/../../stubs/{$runtime}/common/auth/Register.php.stub";
        $componentTarget = app_path("Livewire/Auth/Register.php");

        if (File::exists($componentSource)) {
            $content = File::get($componentSource);
            $content = str_replace(
                ['{{ NAMESPACE }}', '{{ LAYOUT }}', '{{ VIEW }}'],
                ['App\\Livewire\\Auth', 'layouts.app', 'livewire.auth.register'],
                $content
            );
            File::ensureDirectoryExists(dirname($componentTarget));
            File::put($componentTarget, $content);
        }

        // 2. Component View
        $viewSource = __DIR__ . "/../../stubs/{$runtime}/{$theme}/auth/register.blade.php.stub";
        $viewTarget = resource_path("views/livewire/auth/register.blade.php");

        if (File::exists($viewSource)) {
            $content = File::get($viewSource);
            File::ensureDirectoryExists(dirname($viewTarget));
            File::put($viewTarget, $content);
        }

        // 3. Update Auth Routes to include Register
        $routePath = base_path("routes/auth.php");
        if (File::exists($routePath)) {
            $routeContent = File::get($routePath);
            if (! str_contains($routeContent, "Register::class")) {
                $routeContent = str_replace(
                    "use App\\Livewire\\Auth\\Login;",
                    "use App\\Livewire\\Auth\\Login;\nuse App\\Livewire\\Auth\\Register;",
                    $routeContent
                );
                $routeContent = str_replace(
                    "Route::get('login', Login::class)->name('login');",
                    "Route::get('login', Login::class)->name('login');\n    Route::get('register', Register::class)->name('register');",
                    $routeContent
                );
                File::put($routePath, $routeContent);
            }
        }
    }

    protected function scaffoldRecovery(Fabricator $fabricator)
    {
        // Implementation will follow with stubs
    }

    protected function scaffoldProfile(Fabricator $fabricator)
    {
        $theme = config('fabric.theme', 'tailwind');
        $runtime = config('fabric.runtime', 'livewire');

        // 1. Component Logic
        $componentSource = __DIR__ . "/../../stubs/{$runtime}/common/auth/Profile.php.stub";
        $componentTarget = app_path("Livewire/Auth/Profile.php");

        if (File::exists($componentSource)) {
            $content = File::get($componentSource);
            $content = str_replace(
                ['{{ NAMESPACE }}', '{{ VIEW }}'],
                ['App\\Livewire\\Auth', 'livewire.auth.profile'],
                $content
            );
            File::ensureDirectoryExists(dirname($componentTarget));
            File::put($componentTarget, $content);
        }

        // 2. Component View
        $viewSource = __DIR__ . "/../../stubs/{$runtime}/{$theme}/auth/profile.blade.php.stub";
        $viewTarget = resource_path("views/livewire/auth/profile.blade.php");

        if (File::exists($viewSource)) {
            $content = File::get($viewSource);
            File::ensureDirectoryExists(dirname($viewTarget));
            File::put($viewTarget, $content);
        }

        // 3. Update Auth Routes to include Profile
        $routePath = base_path("routes/auth.php");
        if (File::exists($routePath)) {
            $routeContent = File::get($routePath);
            if (! str_contains($routeContent, "Profile::class")) {
                $routeContent = str_replace(
                    "use App\\Livewire\\Auth\\Login;",
                    "use App\\Livewire\\Auth\\Login;\nuse App\\Livewire\\Auth\\Profile;",
                    $routeContent
                );
                $routeContent = str_replace(
                    "Route::middleware('auth')->group(function () {",
                    "Route::middleware('auth')->group(function () {\n    Route::get('profile', Profile::class)->name('profile');",
                    $routeContent
                );
                File::put($routePath, $routeContent);
            }
        }
    }

    protected function scaffoldSessions(Fabricator $fabricator)
    {
        // Implementation will follow with stubs
    }

    protected function scaffoldRoutes(Fabricator $fabricator)
    {
        $runtime = config('fabric.runtime', 'livewire');
        $routeSource = __DIR__ . "/../../stubs/{$runtime}/common/auth/routes.php.stub";
        $routeTarget = base_path("routes/auth.php");

        if (File::exists($routeSource)) {
            $content = File::get($routeSource);
            File::put($routeTarget, $content);

            // Register in web.php if not already there
            $webPath = base_path("routes/web.php");
            if (File::exists($webPath)) {
                $webContent = File::get($webPath);
                if (! str_contains($webContent, "require __DIR__.'/auth.php'")) {
                    File::append($webPath, "\nrequire __DIR__.'/auth.php';\n");
                }
            }
        }
    }
}
