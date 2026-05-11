<?php

declare(strict_types=1);

namespace CLCBWS\Fabric;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use Illuminate\Support\ServiceProvider;

class FabricServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mountPharEngine();

        // 🧬 Bulletproof Path Resolution
        $packagePath = \str_replace('\\', '/', \dirname(__DIR__));
        if (\str_starts_with($packagePath, 'phar://')) {
            $packagePath = \str_replace(['phar://', '/bin/fabric.phar', '/src'], '', $packagePath);
        }

        $this->mergeConfigFrom($packagePath . '/config/fabric.php', 'fabric');

        // 🛡️ Internal Registry Defaults (Hardened)
        if (!config('fabric.registry.url')) {
            config(['fabric.registry.url' => 'https://tmltbnodgzxujahdllpq.supabase.co']);
        }
        if (!config('fabric.registry.key')) {
            config(['fabric.registry.key' => 'sb_publishable_YEk2DaZ6Vdtz8cwS8l5hIQ_jcHhEXIH']);
        }

        // Bind Contracts
        $this->app->singleton(\CLCBWS\Fabric\Engines\Guard::class, \CLCBWS\Fabric\Engines\Guard::class);
        $this->app->singleton(\CLCBWS\Fabric\Contracts\LoomContract::class, \CLCBWS\Fabric\Engines\Loom::class);
        $this->app->singleton(\CLCBWS\Fabric\Contracts\FabricatorContract::class, \CLCBWS\Fabric\Engines\Fabricator::class);
        $this->app->singleton(\CLCBWS\Fabric\Services\SearchRegistry::class);
        $this->app->singleton(\CLCBWS\Fabric\Services\ViewCompiler::class);

        // Bind Facade
        $this->app->bind('fabric', function ($app) {
            return $app->make(\CLCBWS\Fabric\Contracts\FabricatorContract::class);
        });

        // Strictly dev-only guarding for commands and registration
        if (app()->isLocal() || \in_array(app()->environment(), \config('fabric.env_guard', ['local', 'staging']))) {
            $this->registerCommands();
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $packagePath = \str_replace('\\', '/', \dirname(__DIR__));
        if (\str_starts_with($packagePath, 'phar://')) {
            $packagePath = \str_replace(['phar://', '/bin/fabric.phar', '/src'], '', $packagePath);
        }

        $this->loadViewsFrom($packagePath . '/resources/views', 'fabric');

        if ($this->app->runningInConsole()) {
            $this->publishResources($packagePath);
        }

        \Illuminate\Support\Facades\Blade::anonymousComponentPath(resource_path('views/components/fabric'), 'fabric');
        \Illuminate\Support\Facades\Blade::anonymousComponentPath(resource_path('views/layouts/fabric'), 'fabric');

        $this->registerLivewireComponents();
        $this->registerRoutes();
    }

    protected function registerRoutes(): void
    {
        $prefix = \config('fabric.prefix', 'admin');

        \Illuminate\Support\Facades\Route::middleware(\config('fabric.middleware', ['web']))->group(function () use ($prefix) {
            \Illuminate\Support\Facades\Route::get($prefix . '/fabric/docs', [\CLCBWS\Fabric\Http\Controllers\FabricDocController::class, 'index'])->name('fabric.docs.index');
            \Illuminate\Support\Facades\Route::get($prefix . '/fabric/docs/{template}', [\CLCBWS\Fabric\Http\Controllers\FabricDocController::class, 'template'])->name('fabric.docs.template');
            \Illuminate\Support\Facades\Route::get($prefix . '/fabric/docs/{template}/{section}', [\CLCBWS\Fabric\Http\Controllers\FabricDocController::class, 'component'])->name('fabric.docs.component');
        });
    }

    protected function registerLivewireComponents(): void
    {
        \Livewire\Livewire::component('fabric.components.chart', \CLCBWS\Fabric\Livewire\Components\Chart::class);
        \Livewire\Livewire::component('fabric.components.spotlight', \CLCBWS\Fabric\Livewire\Components\Spotlight::class);
    }

    /**
     * Register the package commands.
     */
    protected function registerCommands(): void
    {
        $this->commands([
            \CLCBWS\Fabric\Commands\DoctorCommand::class,
            \CLCBWS\Fabric\Commands\ListResourcesCommand::class,
            \CLCBWS\Fabric\Commands\PublishStubsCommand::class,
            \CLCBWS\Fabric\Commands\GenerateResourceCommand::class,
            \CLCBWS\Fabric\Commands\GenerateSettingsCommand::class,
            \CLCBWS\Fabric\Commands\SeedCommand::class,
            \CLCBWS\Fabric\Commands\AssetsCommand::class,
            \CLCBWS\Fabric\Commands\WizardCommand::class,
            \CLCBWS\Fabric\Commands\ReverseMigrationCommand::class,
            \CLCBWS\Fabric\Commands\AlchemyCommand::class,
            \CLCBWS\Fabric\Commands\AuthCommand::class,
            \CLCBWS\Fabric\Commands\HealCommand::class,
            \CLCBWS\Fabric\Commands\ApiCommand::class,
            \CLCBWS\Fabric\Commands\InstallCommand::class,
            \CLCBWS\Fabric\Commands\VerifyCommand::class,
            \CLCBWS\Fabric\Commands\GuardCommand::class,
            \CLCBWS\Fabric\Commands\EnvSecurityCommand::class,
            \CLCBWS\Fabric\Commands\SentryCommand::class,
            \CLCBWS\Fabric\Commands\ImportCommand::class,
            \CLCBWS\Fabric\Commands\LintCommand::class,
            \CLCBWS\Fabric\Commands\StubForgeCommand::class,
            \CLCBWS\Fabric\Commands\GraphCommand::class,
            \CLCBWS\Fabric\Commands\JailCommand::class,
            \CLCBWS\Fabric\Commands\HydrateCommand::class,
            \CLCBWS\Fabric\Commands\PostmanCommand::class,
            \CLCBWS\Fabric\Commands\AnonCommand::class,
            \CLCBWS\Fabric\Commands\VacuumCommand::class,
            \CLCBWS\Fabric\Commands\PurgeCommand::class,
            \CLCBWS\Fabric\Commands\ContextCommand::class,
            \CLCBWS\Fabric\Commands\LogCommand::class,
            \CLCBWS\Fabric\Commands\ReadyCommand::class,
            \CLCBWS\Fabric\Commands\FabricComponentCommand::class,
            \CLCBWS\Fabric\Commands\FabricPluginCommand::class,
            \CLCBWS\Fabric\Commands\LexiconCommand::class,
            \CLCBWS\Fabric\Commands\AnalyticsCommand::class,
            \CLCBWS\Fabric\Commands\SnapshotCommand::class,
            \CLCBWS\Fabric\Commands\RegisterCommand::class,
            \CLCBWS\Fabric\Commands\LoginCommand::class,
            \CLCBWS\Fabric\Commands\ForgeCommand::class,
        ]);
    }

    /**
     * Publish package resources.
     */
    protected function publishResources(string $packagePath): void
    {
        $this->publishes([
            $packagePath . '/config/fabric.php' => \config_path('fabric.php'),
        ], 'fabric-config');

        $this->publishes([
            $packagePath . '/stubs' => \base_path('stubs/fabric'),
        ], 'fabric-stubs');

        $this->publishes([
            $packagePath . '/stubs/common/js' => public_path('vendor/fabric/common/js'),
        ], 'fabric-assets');

        $this->publishes([
            $packagePath . '/Livewire/Fabric' => \app_path('Livewire/Fabric'),
        ], 'fabric-components');

        $this->publishes([
            $packagePath . '/resources/views' => \resource_path('views/vendor/fabric'),
        ], 'fabric-views');

        // Layouts for slim installs
        $this->publishes([
            $packagePath . '/resources/views/layouts' => \resource_path('views/layouts/fabric'),
        ], 'fabric-layouts');
    }

    protected function mountPharEngine(): void
    {
        $pharPath = __DIR__ . '/../bin/fabric.phar';

        if (File::exists($pharPath) && !str_starts_with(__FILE__, 'phar://')) {
            \Phar::loadPhar($pharPath, 'fabric.phar');

            // 🧬 Register a custom autoloader for PHAR-based classes
            spl_autoload_register(function ($class) {
                if (str_starts_with($class, 'CLCBWS\\Fabric\\')) {
                    $relativeClass = str_replace('CLCBWS\\Fabric\\', '', $class);
                    $filePath = 'phar://fabric.phar/' . str_replace('\\', '/', $relativeClass) . '.php';

                    if (file_exists($filePath)) {
                        require_once $filePath;
                    }
                }
            }, true, true);
        }
    }
}
