<?php

declare(strict_types=1);

namespace CLCBWS\Fabric\Commands;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use Illuminate\Console\Command;

class PublishStubsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fabric:stubs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish the Fabric stubs for customization';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $targetPath = base_path('stubs/fabric');

        if (File::isDirectory($targetPath)) {
            if (!$this->confirm('Stubs already exist. Overwrite?')) {
                return;
            }
        }

        File::ensureDirectoryExists($targetPath);
        File::copyDirectory(__DIR__ . '/../../stubs', $targetPath);

        $this->info("Stubs published to: {$targetPath}");
        $this->info("You can now modify these and Fabric will prefer them over the internal stubs.");
    }
}
