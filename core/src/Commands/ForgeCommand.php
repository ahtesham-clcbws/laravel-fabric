<?php

declare(strict_types=1);

namespace CLCBWS\Fabric\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ForgeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fabric:forge {manifest? : Path to the manifest file (JSON/YAML)} {--dry-run}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Batch-forge an entire application architecture from a single manifest file';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $manifestPath = $this->argument('manifest') ?: base_path('fabric.json');

        if (!File::exists($manifestPath)) {
            $this->error("Manifest file not found at: {$manifestPath}");
            $this->line("Please create a fabric.json or specify a path.");
            return;
        }

        $extension = pathinfo($manifestPath, PATHINFO_EXTENSION);
        $data = $this->parseManifest($manifestPath, $extension);

        if (empty($data)) {
            $this->error("Manifest is empty or invalid.");
            return;
        }

        $this->components->info("Fabric Forge: Initiating batch generation...");

        foreach ($data['models'] ?? [] as $model => $config) {
            $this->forgeModel($model, $config);
        }

        $this->components->info("Forge complete. Architecture has been woven.");
    }

    /**
     * Parse the manifest file.
     */
    protected function parseManifest(string $path, string $extension): array
    {
        $content = File::get($path);

        if ($extension === 'json') {
            return json_decode($content, true) ?: [];
        }

        // 🛡️ Zero-Dependency YAML Fallback
        if (class_exists(\Symfony\Component\Yaml\Yaml::class)) {
            return \Symfony\Component\Yaml\Yaml::parse($content);
        }

        $this->warn("Symfony Yaml component not found. Falling back to basic key-value parsing.");
        return $this->basicYamlParse($content);
    }

    /**
     * A very basic YAML-like parser for simple key-value pairs (Zero-Dependency fallback).
     */
    protected function basicYamlParse(string $content): array
    {
        $lines = explode("\n", $content);
        $result = ['models' => []];
        $currentModel = null;

        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line) || str_starts_with($line, '#')) continue;

            if (str_ends_with($line, ':')) {
                $currentModel = rtrim($line, ':');
                $result['models'][$currentModel] = [];
            } elseif ($currentModel && str_contains($line, ':')) {
                [$key, $value] = explode(':', $line, 2);
                $result['models'][$currentModel][trim($key)] = trim($value);
            }
        }

        return $result;
    }

    /**
     * Forge an individual model from the manifest.
     */
    protected function forgeModel(string $model, array $config): void
    {
        $this->line("  - Forging: [{$model}]");

        $params = [
            'model' => $model,
            '--theme' => $config['theme'] ?? 'preline',
            '--force' => true,
        ];

        if ($config['tenant'] ?? false) {
            $params['--tenant'] = true;
        }

        if ($this->option('dry-run')) {
            $this->info("    [Dry Run] Would run: fabric:generate " . json_encode($params));
            return;
        }

        try {
            $this->call('fabric:generate', $params);
        } catch (\Exception $e) {
            $this->error("    Failed to forge {$model}: " . $e->getMessage());
        }
    }
}
