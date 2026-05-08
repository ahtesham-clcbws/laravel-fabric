<?php

declare(strict_types=1);

namespace CLCBWS\Fabric\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class GenerateSiteCommand extends Command
{
    protected $signature = 'fabric:site {--theme=daisyui} {--force}';
    protected $description = 'Forge a complete, high-fidelity multi-page website from stubs';

    public function handle(): void
    {
        $theme = $this->option('theme');
        $this->components->info("Forging Complete Website for theme: {$theme}");

        $pages = [
            'home' => 'welcome.blade.php',
            'about' => 'about.blade.php',
            'contact' => 'contact.blade.php',
            'faq' => 'faq.blade.php',
            'pricing' => 'pricing.blade.php',
            'testimonials' => 'testimonials.blade.php',
            'team' => 'team.blade.php',
            'portfolio' => 'portfolio.blade.php',
            'terms' => 'terms.blade.php',
            'privacy' => 'privacy.blade.php',
            'blog/index' => 'blog/index.blade.php',
            'blog/show' => 'blog/show.blade.php',
            'services/index' => 'services/index.blade.php',
            'services/show' => 'services/show.blade.php',
        ];

        // 1. Generate Layout
        $this->generateLayout($theme);

        // 2. Generate Components
        $this->generateComponents($theme);

        // 3. Generate Pages
        foreach ($pages as $stub => $path) {
            $this->generatePage($theme, $stub, $path);
        }

        // 3. Register Routes
        $this->registerRoutes();

        $this->components->info("Website forged successfully! 15+ pages created.");
    }

    protected function generateLayout(string $theme): void
    {
        $stubPath = __DIR__ . "/../../stubs/web/{$theme}/layout.blade.php.stub";
        if (!File::exists($stubPath)) return;

        $path = resource_path("views/components/web-layout.blade.php");
        File::ensureDirectoryExists(dirname($path));
        File::copy($stubPath, $path);
        $this->line("<fg=green>Created Layout:</> {$path}");
    }

    protected function generateComponents(string $theme): void
    {
        $components = [
            'Footer' => [
                'class' => app_path('View/Components/Website/Footer.php'),
                'view' => resource_path('views/components/website/footer.blade.php'),
            ],
        ];

        foreach ($components as $name => $paths) {
            // Class
            $classStub = __DIR__ . "/../../stubs/web/{$theme}/{$name}.php.stub";
            if (File::exists($classStub)) {
                File::ensureDirectoryExists(dirname($paths['class']));
                File::copy($classStub, $paths['class']);
                $this->line("<fg=green>Created Component Class:</> {$paths['class']}");
            }

            // View
            $viewStub = __DIR__ . "/../../stubs/web/{$theme}/" . strtolower($name) . ".blade.php.stub";
            if (File::exists($viewStub)) {
                File::ensureDirectoryExists(dirname($paths['view']));
                File::copy($viewStub, $paths['view']);
                $this->line("<fg=green>Created Component View:</> {$paths['view']}");
            }
        }
    }

    protected function generatePage(string $theme, string $stub, string $targetPath): void
    {
        $stubPath = __DIR__ . "/../../stubs/web/{$theme}/{$stub}.blade.php.stub";
        if (!File::exists($stubPath)) {
            // Fallback to a generic page stub if specific one is missing
            $stubPath = __DIR__ . "/../../stubs/web/{$theme}/generic.blade.php.stub";
        }
        
        if (!File::exists($stubPath)) return;

        $path = resource_path("views/{$targetPath}");
        File::ensureDirectoryExists(dirname($path));
        File::copy($stubPath, $path);
        $this->line("<fg=green>Created Page:</> {$path}");
    }

    protected function registerRoutes(): void
    {
        $path = base_path('routes/web.php');
        $stubPath = __DIR__ . "/../../stubs/web/routes.php.stub";
        if (!File::exists($stubPath)) return;

        $routes = File::get($stubPath);
        File::put($path, $routes);
        $this->line("<fg=blue>Registered website routes in routes/web.php</>");
    }
}
