<?php

declare(strict_types=1);

namespace CLCBWS\Fabric\Commands;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use Illuminate\Console\Command;
use CLCBWS\Fabric\Engines\Alchemist;
use function Laravel\Prompts\text;
use function Laravel\Prompts\textarea;

class AlchemyCommand extends Command
{
    protected $signature = 'fabric:alchemy';
    protected $description = 'Transmute a static component into a dynamic Fabric stub';

    public function handle(Alchemist $alchemist): int
    {
        $this->components->info("The Alchemist: Transmuting Static UI into Dynamic Stubs");

        $modelName = text(
            label: 'What is the name of the Model used in this component?',
            placeholder: 'User',
            required: true
        );

        $content = textarea(
            label: 'Paste the static HTML/Blade content here:',
            placeholder: '<div class="text-indigo-600">User Details</div>...',
            required: true
        );

        $transmuted = $alchemist->transmute($content, $modelName);

        $filename = text(
            label: 'What should we name this stub?',
            placeholder: 'custom_view.blade.php.stub',
            required: true
        );

        $path = \base_path("stubs/fabric/custom/{$filename}");
        
        File::ensureDirectoryExists(dirname($path));
        File::put($path, $transmuted);

        $this->components->info("Transmutation complete! Stub saved to: {$path}");
        
        return self::SUCCESS;
    }
}
