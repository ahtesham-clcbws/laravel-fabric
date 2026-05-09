<?php

namespace CLCBWS\Fabric\Commands;

use CLCBWS\Fabric\Registry\ComponentRegistry;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ListResourcesCommand extends Command
{
    protected $signature = 'fabric:list {template? : Filter by template}';
    protected $description = 'List all available templates and their components';

    public function handle()
    {
        $registry = ComponentRegistry::all();
        $filter = $this->argument('template');

        if ($filter) {
            $filter = Str::lower($filter);
            if (!isset($registry[$filter])) {
                $this->error("Template [{$filter}] not found.");
                return;
            }
            $registry = [$filter => $registry[$filter]];
        }

        $this->components->info("Fabric Universal Library: " . count($registry) . " Templates Indexed");

        foreach ($registry as $template => $sections) {
            $this->line("<fg=blue;options=bold>[" . strtoupper($template) . "]</>");
            $this->line("<fg=gray>  Sections: " . implode(', ', $sections) . "</>");
            $this->line("");
        }

        $this->info("Usage: php artisan fabric:component {template}:{section}");
    }
}
