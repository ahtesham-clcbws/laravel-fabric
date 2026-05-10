<?php

namespace CLCBWS\Fabric\Commands;

use Illuminate\Console\Command;
use CLCBWS\Fabric\Registry\PluginRegistry;
use Illuminate\Support\Facades\File;

class FabricPluginCommand extends Command
{
    protected $signature = 'fabric:plugin {name?} {--force} {--dry-run}';
    protected $description = 'Install native Fabric plugins (Package Killers) with intelligent conflict detection';

    public function handle()
    {
        $name = $this->argument('name');
        $plugins = PluginRegistry::all();

        if ($name) {
            if (!isset($plugins[$name])) {
                $this->error("Plugin [{$name}] not found in registry.");
                return;
            }
            $this->installPlugin($name, $plugins[$name]);
            return;
        }

        $this->info("Fabric Native Plugin Orchestrator");
        foreach ($plugins as $key => $config) {
            $this->installPlugin($key, $config);
        }
    }

    protected function installPlugin(string $key, array $config)
    {
        $this->comment("Auditing [{$config['name']}]...");

        // 1. Check for 3rd-party package competitors
        foreach ($config['competitors'] as $competitor) {
            if (class_exists($competitor) || interface_exists($competitor)) {
                $this->warn("! Conflict Detected: [{$competitor}] is already installed. Native [{$key}] will not be injected.");
                return;
            }
        }

        // 2. Check for existing native files (unless --force)
        if (!$this->option('force')) {
            foreach ($config['stubs'] as $source => $target) {
                if (File::exists($this->resolveTargetPath($target))) {
                    $this->warn("! Native files for [{$key}] already exist. skipping. Use --force to overwrite.");
                    return;
                }
            }
        }

        if ($this->option('dry-run')) {
            $this->info("? [{$config['name']}] is ready for injection.");
            return;
        }

        $this->info("+ No competition detected. Injecting native [{$config['name']}] suite...");

        foreach ($config['stubs'] as $source => $target) {
            $this->injectStub($source, $target);
        }

        $this->info("✓ [{$config['name']}] is now native to your project.");
    }

    protected function injectStub(string $source, string $target)
    {
        $stubPath = __DIR__ . "/../../stubs/plugins/{$source}";
        
        if (!File::exists($stubPath)) {
            $this->error("  - Stub missing: {$source}");
            return;
        }

        $targetPath = $this->resolveTargetPath($target);

        if (!File::exists(dirname($targetPath))) {
            File::makeDirectory(dirname($targetPath), 0755, true);
        }

        $content = File::get($stubPath);
        $content = str_replace('{{ NAMESPACE }}', 'App', $content);

        File::put($targetPath, $content);
        $this->line("  - Created: " . str_replace(base_path(), '', $targetPath));
    }

    protected function resolveTargetPath(string $target): string
    {
        if (str_contains($target, 'migrations/')) {
            // Find if migration already exists with the same name (regardless of timestamp)
            $basename = basename($target);
            $cleanName = str_replace('{{timestamp}}_', '', $basename);
            
            $existing = glob(database_path('migrations/*_' . $cleanName));
            if (!empty($existing)) {
                return $existing[0];
            }

            $filename = str_replace('{{timestamp}}', date('Y_m_d_His'), $basename);
            return database_path('migrations/' . $filename);
        }

        if (str_starts_with($target, '../')) {
            return base_path(str_replace('../', '', $target));
        }

        return app_path($target);
    }
}
