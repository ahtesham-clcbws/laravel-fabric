<?php

namespace CLCBWS\Fabric\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class FabricComponentCommand extends Command
{
    protected $signature = 'fabric:component {name : The component name (template:section)} {--force}';
    protected $description = 'Extract a specific section/component from a Fabric template';

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

        $templateDir = __DIR__ . "/../../stubs/templates/{$template}";
        if (!File::isDirectory($templateDir)) {
            $this->error("Template [{$template}] not found.");
            return;
        }

        $sourceFile = "{$templateDir}/welcome.blade.php.stub";
        if (!File::exists($sourceFile)) {
            $sourceFile = "{$templateDir}/index.blade.php.stub";
        }

        if (!File::exists($sourceFile)) {
            $this->error("Source file for template [{$template}] not found.");
            return;
        }

        $content = File::get($sourceFile);
        $extracted = $this->extractSection($content, $section);

        if (!$extracted) {
            $this->error("Section [{$section}] not found in template [{$template}].");
            
            $registry = \CLCBWS\Fabric\Registry\ComponentRegistry::all();
            if (isset($registry[$template])) {
                $this->info("Available sections for [{$template}]: " . implode(', ', $registry[$template]));
            }
            return;
        }

        // Ensure asset paths are relative to the template's published assets
        $extracted = str_replace(
            ['assets/', '../../assets/'],
            ['{{ asset("vendor/fabric/templates/' . $template . '/assets/") }}/', '{{ asset("vendor/fabric/templates/' . $template . '/assets/") }}/'],
            $extracted
        );

        // Normalize to Core Tailwind
        $extracted = \CLCBWS\Fabric\Utils\TailwindCleaner::clean($extracted);

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
