<?php

declare(strict_types=1);

namespace CLCBWS\Fabric\Commands;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use CLCBWS\Fabric\Engines\Loom;
use Illuminate\Console\Command;

class ContextCommand extends Command
{
    protected $signature = 'fabric:context';
    protected $description = 'Generate a high-fidelity architectural context for AI pairing';

    public function handle(Loom $loom): void
    {
        $this->components->info("Fabric AI-Context: Generating Cognitive Map...");

        $modelPath = app_path('Models');
        $models = collect(File::exists($modelPath) ? File::files($modelPath) : [])
            ->map(fn($f) => "App\\Models\\" . $f->getFilenameWithoutExtension())
            ->filter(fn($m) => class_exists($m));

        $context = "# 🛡️ Laravel Fabric: Application Context\n\n";
        
        $context .= "## 🤖 Rules of Engagement for AI Agents\n";
        $context .= "> [!IMPORTANT]\n";
        $context .= "> This codebase utilizes **Surgical Patching** (Heal Points). Do NOT remove or relocate the following markers:\n";
        $context .= "> 1. `<!-- [FABRIC-HEAL-FORM] -->`: Used by `fabric:heal` to inject new database columns into views.\n";
        $context .= "> 2. `// [FABRIC-RELATIONSHIP-PROPERTIES]`: Used to inject dynamic Eloquent properties.\n";
        $context .= "> 3. `// [FABRIC-RELATIONSHIP-FETCH]`: Used to inject dynamic data fetching logic.\n\n";

        $context .= "## 🧬 Data Architecture\n\n";

        foreach ($models as $modelClass) {
            $contract = $loom->introspect($modelClass);
            $name = class_basename($modelClass);
            
            $context .= "### Model: {$name}\n";
            $context .= "- **Namespace**: {$modelClass}\n";
            $context .= "- **Fields**: " . implode(', ', array_keys($contract['fields'])) . "\n";
            $context .= "- **Traits**: " . implode(', ', class_uses($modelClass)) . "\n";
            
            if (!empty($contract['relationships']['belongs_to'])) {
                $context .= "- **Relationships**: " . implode(', ', array_keys($contract['relationships']['belongs_to'])) . "\n";
            }
            $context .= "\n";
        }

        $context .= "## 🌐 API & Controller Intelligence\n\n";
        $apiPath = app_path('Http/Controllers/Api');
        $controllers = File::exists($apiPath) ? File::files($apiPath) : [];
        
        foreach ($controllers as $file) {
            $content = File::get($file->getPathname());
            $name = $file->getFilenameWithoutExtension();
            
            $context .= "### Controller: {$name}\n";
            
            // Extract methods for AI context
            preg_match_all('/public function (\w+)/', $content, $matches);
            $methods = $matches[1] ?? [];
            $context .= "- **Endpoints**: " . implode(', ', $methods) . "\n";
            
            // Guess logic intent
            if (Str::contains($content, 'validate')) $context .= "- **Features**: Includes Validation\n";
            if (Str::contains($content, 'DB::transaction')) $context .= "- **Features**: Atomic Transactions\n";
            
            $context .= "\n";
        }

        $context .= "## 🛡️ Security & Middleware Map\n\n";
        $routeFiles = ['web.php', 'api.php', 'fabric.php', 'auth.php'];
        
        foreach ($routeFiles as $file) {
            $path = base_path("routes/{$file}");
            if (File::exists($path)) {
                $content = File::get($path);
                $context .= "### Routes: {$file}\n";
                
                // Extract middleware groups
                preg_match_all('/middleware\([\'"]([\w:,|]+)[\'"]\)/', $content, $matches);
                $groups = array_unique($matches[1] ?? []);
                $context .= "- **Active Middleware**: " . (empty($groups) ? 'None' : implode(', ', $groups)) . "\n";
                
                if (Str::contains($content, 'Route::resource')) $context .= "- **Patterns**: RESTful Resources detected\n";
                if (Str::contains($content, 'Route::get')) $context .= "- **Patterns**: Static Endpoints detected\n";
                
                $context .= "\n";
            }
        }

        File::put(base_path('fabric_context.md'), $context);
        $this->info("✨ AI-Context generated: fabric_context.md. Paste this into your LLM for perfect context.");
    }
}
