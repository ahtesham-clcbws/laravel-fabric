<?php

declare(strict_types=1);

namespace CLCBWS\Fabric\Commands;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use CLCBWS\Fabric\Engines\Loom;
use Illuminate\Console\Command;

class GraphCommand extends Command
{
    protected $signature = 'fabric:graph';
    protected $description = 'Generate a high-fidelity Mermaid.js relationship graph of your forged resources';

    public function handle(Loom $loom): void
    {
        $this->components->info("Forging Nexus Graph: Analyzing Resource Connections...");

        // Get all models in app/Models
        $modelPath = app_path('Models');
        $models = collect(File::exists($modelPath) ? File::files($modelPath) : [])
            ->map(fn($f) => "App\\Models\\" . $f->getFilenameWithoutExtension())
            ->filter(fn($m) => class_exists($m));

        $mermaid = "erDiagram\n";

        foreach ($models as $modelClass) {
            $contract = $loom->introspect($modelClass);
            $name = class_basename($modelClass);

            foreach ($contract['relationships']['belongs_to'] ?? [] as $field => $rel) {
                $related = class_basename($rel['model']);
                $mermaid .= "    {$related} ||--o{ {$name} : \"owns\"\n";
            }
        }

        $this->newLine();
        $this->info("Nexus Graph Forged! Paste the following into a Mermaid-compatible viewer:");
        $this->newLine();
        $this->line($mermaid);
        $this->newLine();
    }
}
