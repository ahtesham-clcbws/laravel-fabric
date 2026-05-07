<?php

namespace CLCBWS\Fabric\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class SentryCommand extends Command
{
    protected $signature = 'fabric:sentry';
    protected $description = 'Inject performance guards (Lazy-Loading protection) into the application';

    public function handle()
    {
        $this->components->info("Activating Performance Sentry...");

        $providerPath = app_path('Providers/AppServiceProvider.php');
        
        if (!File::exists($providerPath)) {
            $this->error("AppServiceProvider not found.");
            return;
        }

        $content = File::get($providerPath);
        
        if (str_contains($content, 'preventLazyLoading')) {
            $this->info("Performance Sentry is already active.");
            return;
        }

        $logic = "\n        \Illuminate\Database\Eloquent\Model::preventLazyLoading(! app()->isProduction());\n";
        
        $content = preg_replace('/public function boot\(\): void\n    \{/', "public function boot(): void\n    {" . $logic, $content);
        
        File::put($providerPath, $content);
        $this->info("✨ Sentry activated! N+1 queries will now throw exceptions in local development.");
    }
}
