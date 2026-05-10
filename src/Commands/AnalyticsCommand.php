<?php

namespace CLCBWS\Fabric\Commands;

use Illuminate\Console\Command;

class AnalyticsCommand extends Command
{
    protected $signature = 'fabric:analytics';
    protected $description = 'Measure code density and project volume using the native Analytics plugin';

    public function handle()
    {
        $class = 'App\\Services\\Analytics\\CodeAnalytics';
        
        if (!class_exists($class)) {
            $this->error('Analytics plugin not found. Run: php artisan fabric:plugin analytics');
            return;
        }

        $this->info('Running Fabric Code Analytics...');
        
        $analytics = new $class();
        $metrics = $analytics->measure(base_path('app'));
        
        $this->components->twoColumnDetail('Total Application Files', $metrics['total_files']);
        $this->components->twoColumnDetail('Total Application Lines', $metrics['total_lines']);
        
        $this->newLine();
        $this->info('Analytics completed successfully.');
    }
}
