<?php

namespace CLCBWS\Fabric\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class LintCommand extends Command
{
    protected $signature = 'fabric:lint';
    protected $description = 'Audit the architectural integrity of your models and components';

    public function handle()
    {
        $this->components->info("Fabric Architectural Auditor: Scanning for Senior Standards...");

        $models = File::files(app_path('Models'));
        $score = 100;
        $issues = 0;

        foreach ($models as $file) {
            $content = File::get($file->getPathname());
            $name = $file->getFilenameWithoutExtension();

            $this->newLine();
            $this->line("<fg=gray>Auditing:</> <fg=white;bold>{$name}</>");

            // 1. Check for Auditable
            if (!Str::contains($content, 'Auditable')) {
                $this->components->twoColumnDetail("Auditable Trait", '<fg=yellow>MISSING (-10)</>');
                $score -= 10;
                $issues++;
            } else {
                $this->components->twoColumnDetail("Auditable Trait", '<fg=green>PASS</>');
            }

            // 2. Check for HasFiles
            if (Str::contains($content, 'image') && !Str::contains($content, 'HasFiles')) {
                $this->components->twoColumnDetail("Media Handler", '<fg=yellow>MISSING (-5)</>');
                $score -= 5;
                $issues++;
            }

            // 3. Check for DocBlocks
            if (!Str::contains($content, '/**')) {
                $this->components->twoColumnDetail("Documentation", '<fg=yellow>MISSING (-5)</>');
                $score -= 5;
                $issues++;
            }
        }

        $this->newLine();
        $this->info("Audit Complete. Final Architectural Score: {$score}/100");
        
        if ($issues > 0) {
            $this->warn("Found {$issues} architectural suggestions. Run 'fabric:heal' to fix some of these automatically.");
        } else {
            $this->info("✨ Your architecture is pristine. Senior Architect status achieved.");
        }
    }
}
