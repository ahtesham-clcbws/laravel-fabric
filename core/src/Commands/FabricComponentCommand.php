<?php

namespace CLCBWS\Fabric\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class FabricComponentCommand extends Command
{
    protected $signature = 'fabric:component {name : The component name (e.g., daisyui:button or preline:hero-section)} 
                            {--type= : The visual variant (solid, soft, outline, ghost, soft, link)} 
                            {--size= : The size (xs, sm, md, lg, xl)} 
                            {--color= : The palette color (primary, secondary, success, warning, error, info)}
                            {--icon= : Lucide/Heroicon name to inject}
                            {--force : Overwrite existing file}';

    protected $description = 'Forge a high-fidelity, themed UI component from the Fabric library';

    protected $help = <<<HELP
The <info>fabric:component</info> command is the heart of the Fabric Design System. 
It allows you to forge atomic components, compositional sections, and full-page layouts.

<comment>RESOLUTION HIERARCHY:</comment>
1. User Customization (stubs/fabric/livewire/...)
2. Atomic Components (stubs/livewire/{library}/components/...)
3. Marketing Sections (stubs/livewire/{library}/examples/...)
4. Full Blueprints (stubs/livewire/{library}/layouts/...)
5. Template Extraction (Extracts from welcome.blade.php.stub via markers)

<comment>SMART FORGING FLAGS:</comment>
Use flags to override default @props in real-time during the forge process:
--type=soft --color=success --size=lg

<comment>EXAMPLES:</comment>
php artisan fabric:component preline:button --type=soft --color=success
php artisan fabric:component daisyui:hero-section
php artisan fabric:component floatui:sidebar-layout
HELP;

    public function handle()
    {
        $name = $this->argument('name');
        if (!Str::contains($name, ':')) {
            $this->error("Format must be template:section (e.g., startup:hero)");
            return;
        }

        [$template, $section] = explode(':', $name);
        $template = Str::lower($template);
        $section = Str::lower($section);

        // Prioritize published stubs for customization
        $baseStubPath = File::isDirectory(base_path('stubs/fabric/livewire')) 
            ? base_path('stubs/fabric/livewire') 
            : __DIR__ . '/../../stubs/livewire';

        $templateDir = "{$baseStubPath}/{$template}";
        $componentPath = "{$templateDir}/components/{$section}.blade.php.stub";
        $examplePath = "{$templateDir}/examples/{$section}.blade.php.stub";
        $layoutPath = "{$templateDir}/layouts/{$section}.blade.php.stub";

        $extracted = null;

        if (File::exists($componentPath)) {
            $extracted = File::get($componentPath);
        } elseif (File::exists($examplePath)) {
            $extracted = File::get($examplePath);
        } elseif (File::exists($layoutPath)) {
            $extracted = File::get($layoutPath);
        } elseif (File::isDirectory($templateDir)) {
            $sourceFile = "{$templateDir}/welcome.blade.php.stub";
            if (!File::exists($sourceFile)) {
                $sourceFile = "{$templateDir}/index.blade.php.stub";
            }

            if (File::exists($sourceFile)) {
                $content = File::get($sourceFile);
                
                // Smarter extraction: strip suffixes to match template markers
                $lookupName = str_replace(['-section', '-layout'], '', $section);
                $extracted = $this->extractSection($content, $lookupName);
            }
        }

        if (!$extracted) {
            $this->error("Section [{$section}] not found in template [{$template}].");
            
            $registry = \CLCBWS\Fabric\Registry\ComponentRegistry::all();
            if (isset($registry[$template])) {
                $this->info("Available sections for [{$template}]: " . implode(', ', $registry[$template]));
            }
            return;
        }

        $this->info("Forging component [{$section}] from [{$template}]...");

        // Ensure asset paths are relative to the template's published assets
        $extracted = str_replace(
            ['assets/', '../../assets/'],
            ['{{ asset("vendor/fabric/templates/' . $template . '/assets/") }}/', '{{ asset("vendor/fabric/templates/' . $template . '/assets/") }}/'],
            $extracted
        );

        // Normalize to Core Tailwind
        $extracted = \CLCBWS\Fabric\Utils\TailwindCleaner::clean($extracted);

        // Intelligent Compilation based on Flags
        $compiler = app(\CLCBWS\Fabric\Services\ViewCompiler::class);
        $options = [
            'type'    => $this->option('type') ?? $this->option('variant'),
            'size'    => $this->option('size'),
            'color'   => $this->option('color'),
            'icon'    => $this->option('icon'),
        ];

        $extracted = $compiler->compile($extracted, [
            'model' => 'App\\Models\\User', // Dummy model for basic compilation
            'component_options' => array_filter($options),
        ]);

        $targetPath = resource_path("views/components/fabric/{$template}/{$section}.blade.php");
        if (File::exists($targetPath) && !$this->option('force')) {
            if (!$this->confirm("Component [fabric.{$template}.{$section}] already exists. Overwrite?")) {
                return;
            }
        }

        File::ensureDirectoryExists(dirname($targetPath));
        File::put($targetPath, $extracted);

        $this->components->info("Component forged: <x-fabric.{$template}.{$section} />");
        $this->line("<fg=gray>Location: {$targetPath}</>");
    }

    protected function extractSection(string $content, string $section): ?string
    {
        $section = Str::upper($section);
        
        // Pattern 1: Precise END marker
        if (preg_match("/(<!-- ========== {$section} ========== -->)(.*?)(<!-- ========== END {$section} ========== -->)/is", $content, $matches)) {
            return trim($matches[2]);
        }

        // Pattern 2: Start marker to next major section marker
        if (preg_match("/(<!-- ========== {$section} ========== -->)(.*?)(<!-- ==========)/is", $content, $matches)) {
            return trim($matches[2]);
        }

        // Pattern 3: Simple comment markers (e.g. <!-- Hero -->)
        if (preg_match("/(<!-- {$section} -->)(.*?)(<!-- End {$section} -->)/is", $content, $matches)) {
            return trim($matches[2]);
        }

        // Pattern 4: Simple start marker to next simple marker or major marker
        if (preg_match("/(<!-- {$section} -->)(.*?)(<!--)/is", $content, $matches)) {
            return trim($matches[2]);
        }

        return null;
    }
}
