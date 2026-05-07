<?php

namespace CLCBWS\Fabric\Commands;

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
    public function handle()
    {
        $this->components->info('Laravel Fabric: Generated Resources');
        
        $this->info('No resources generated yet. Run fabric:generate {Model} to start.');
    }
}
