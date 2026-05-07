<?php

namespace CLCBWS\Fabric\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class AssetsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fabric:assets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish the core UI components and layouts to your project';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $theme = config('fabric.theme', 'tailwind');
        $runtime = config('fabric.runtime', 'livewire');

        $this->components->info("Publishing Fabric Assets for [{$theme} / {$runtime}]");

        // 1. Publish Components
        $componentSource = __DIR__ . "/../../stubs/{$runtime}/{$theme}/components";
        $componentTarget = resource_path('views/components/fabric');

        if (File::isDirectory($componentSource)) {
            if (!File::isDirectory($componentTarget)) {
                File::makeDirectory($componentTarget, 0755, true);
            }
            foreach (File::allFiles($componentSource) as $file) {
                $targetFile = $componentTarget . '/' . str_replace('.stub', '', $file->getRelativePathname());
                $content = File::get($file->getRealPath());
                $content = $this->replacePlaceholders($content);
                File::put($targetFile, $content);
            }
            $this->components->twoColumnDetail('Atomic Components', '<fg=green>Published</>');
        }

        // 2. Publish Layouts
        $layoutSource = __DIR__ . "/../../stubs/{$runtime}/{$theme}/layouts";
        $layoutTarget = resource_path('views/layouts/fabric');

        if (File::isDirectory($layoutSource)) {
            if (!File::isDirectory($layoutTarget)) {
                File::makeDirectory($layoutTarget, 0755, true);
            }
            foreach (File::allFiles($layoutSource) as $file) {
                $targetFile = $layoutTarget . '/' . str_replace('.stub', '', $file->getRelativePathname());
                $content = File::get($file->getRealPath());
                $content = $this->replacePlaceholders($content);
                File::put($targetFile, $content);
                
                // Mirror to top-level layouts for convenience (app.blade.php, guest.blade.php, web.blade.php)
                $baseName = str_replace('.blade.php.stub', '', $file->getFilename());
                if (in_array($baseName, ['app', 'guest', 'web'])) {
                    File::put(resource_path("views/layouts/{$baseName}.blade.php"), $content);
                }
                if ($baseName === 'sidebar') {
                    File::put(resource_path("views/layouts/app.blade.php"), $content);
                }
            }
            $this->components->twoColumnDetail('Dashboard Layouts', '<fg=green>Published</>');
        }

        // 3. Fallback to Tailwind components if the current theme doesn't have them
        if ($theme !== 'tailwind') {
            $baseComponentSource = __DIR__ . "/../../stubs/{$runtime}/tailwind/components";
            if (File::isDirectory($baseComponentSource)) {
                $this->components->info("Filling gaps with base Tailwind components...");
                foreach (File::allFiles($baseComponentSource) as $file) {
                    $targetFile = $componentTarget . '/' . str_replace('.stub', '', $file->getRelativePathname());
                    if (!File::exists($targetFile)) {
                        $content = File::get($file->getRealPath());
                        $content = $this->replacePlaceholders($content);
                        File::put($targetFile, $content);
                    }
                }
            }
        }

        // 3. Scaffold Omnisearch Logic
        $searchSource = __DIR__ . "/../../stubs/{$runtime}/common/Omnisearch.php.stub";
        $searchTarget = app_path("Livewire/Fabric/Omnisearch.php");
        
        if (File::exists($searchSource)) {
            $content = File::get($searchSource);
            $content = str_replace('{{ NAMESPACE }}', 'App\\Livewire\\Fabric', $content);
            File::ensureDirectoryExists(dirname($searchTarget));
            File::put($searchTarget, $content);
        }

        // 4. Scaffold Lab
        $labSource = __DIR__ . "/../../stubs/livewire/common/Lab.php.stub";
        $labTarget = app_path("Livewire/Fabric/Lab.php");
        
        if (File::exists($labSource)) {
            $content = File::get($labSource);
            $content = str_replace('{{ NAMESPACE }}', 'App\\Livewire\\Fabric', $content);
            File::ensureDirectoryExists(dirname($labTarget));
            File::put($labTarget, $content);
        }

        $this->newLine();
        $this->info("✨ Assets are ready! Use them in your views as <x-fabric::button> or @layout('layouts.fabric.sidebar').");
        
        $this->components->warn("Action Required: Ensure you have Alpine.js installed and add the following to your tailwind.config.js:");
        $this->line("  content: [");
        $this->line("      './resources/views/components/fabric/**/*.blade.php',");
        $this->line("      './resources/views/layouts/fabric/**/*.blade.php',");
        $this->line("  ],");
    }

    /**
     * Replace color placeholders in the given content.
     */
    protected function replacePlaceholders(string $content): string
    {
        $colors = config('fabric.palettes', [
            'primary'   => 'indigo-600',
            'secondary' => 'pink-600',
            'accent'    => 'cyan-600',
            'neutral'   => 'gray-800',
        ]);

        return str_replace(
            ['{{ PRIMARY }}', '{{ SECONDARY }}', '{{ ACCENT }}', '{{ NEUTRAL }}'],
            [
                $colors['primary'] ?? 'indigo-600',
                $colors['secondary'] ?? 'pink-600',
                $colors['accent'] ?? 'cyan-600',
                $colors['neutral'] ?? 'gray-800',
            ],
            $content
        );
    }
}
