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
        $templates = ComponentRegistry::getTemplates();
        $filter = $this->argument('template');

        if ($filter) {
            $filter = Str::lower($filter);
            if (!in_array($filter, $templates)) {
                $this->error("Template [{$filter}] not found.");
                return;
            }
            $templates = [$filter];
        }

        $this->components->info("Fabric Universal Library: " . count($templates) . " Libraries Indexed");

        foreach ($templates as $template) {
            $sections = ComponentRegistry::getSections($template);
            $this->line("<fg=blue;options=bold>[" . strtoupper($template) . "]</>");
            $this->line("<fg=gray>  Total Sections: " . count($sections) . "</>");
            
            // Show first 10 and count remaining for brevity
            $preview = array_slice($sections, 0, 15);
            $this->line("  Available: " . implode(', ', $preview) . (count($sections) > 15 ? " ... and " . (count($sections) - 15) . " more" : ""));
            $this->line("");
        }

        $this->info("Usage: php artisan fabric:component {template}:{section}");
    }
}
