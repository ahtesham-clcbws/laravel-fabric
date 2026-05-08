<?php

declare(strict_types=1);

namespace CLCBWS\Fabric\Commands;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use Illuminate\Console\Command;

class ListResourcesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fabric:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lists all generated resources and their sync status';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->components->info('Laravel Fabric: Generated Resources');
        
        $path = app_path('Livewire/Fabric');
        
        if (!File::isDirectory($path)) {
            $this->info('No resources generated yet. Run fabric:generate {Model} to start.');
            return;
        }

        $resources = File::directories($path);
        
        if (empty($resources)) {
            $this->info('No resources generated yet. Run fabric:generate {Model} to start.');
            return;
        }

        foreach ($resources as $resource) {
            $name = basename($resource);
            if ($name === 'Auth') continue;
            
            $this->components->twoColumnDetail($name, '<fg=green>Active</>');
        }
    }
}
