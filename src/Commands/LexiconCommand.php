<?php

declare(strict_types=1);

namespace CLCBWS\Fabric\Commands;

use CLCBWS\Fabric\Registry\ComponentRegistry;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class LexiconCommand extends Command
{
    protected $signature = 'fabric:lexicon {library? : The UI library to explore}';
    protected $description = 'Explore the high-fidelity UI lexicon for any Fabric design system';

    public function handle(): int
    {
        $library = $this->argument('library');
        $libraries = ComponentRegistry::getTemplates();

        if ($library) {
            return $this->showLibrary($library);
        }

        $this->components->info("Fabric UI Lexicon: " . count($libraries) . " Libraries Integrated");

        foreach ($libraries as $lib) {
            $sections = ComponentRegistry::getSections($lib);
            $atoms = collect($sections)->filter(fn($s) => !str_contains($s, '-section') && !str_contains($s, '-layout'))->count();
            $blocks = count($sections) - $atoms;

            $this->components->twoColumnDetail(
                "<fg=blue;options=bold>" . strtoupper($lib) . "</>",
                "<fg=gray>{$atoms} Atoms | {$blocks} Sections</>"
            );
        }

        $this->newLine();
        $this->info("Usage: php artisan fabric:lexicon {library}");

        return self::SUCCESS;
    }

    protected function showLibrary(string $library): int
    {
        $library = Str::lower($library);
        if (!in_array($library, ComponentRegistry::getTemplates())) {
            $this->error("Library [{$library}] not found.");
            return self::FAILURE;
        }

        $sections = ComponentRegistry::getSections($library);
        
        $this->components->info("Lexicon Explorer: [" . strtoupper($library) . "]");

        $categories = [
            '💎 SMART ATOMS' => collect($sections)->filter(fn($s) => !str_contains($s, '-section') && !str_contains($s, '-layout')),
            '🧱 MARKETING SECTIONS' => collect($sections)->filter(fn($s) => str_contains($s, '-section')),
            '🖥️ PAGE LAYOUTS' => collect($sections)->filter(fn($s) => str_contains($s, '-layout')),
        ];

        foreach ($categories as $label => $items) {
            if ($items->count() > 0) {
                $this->line("\n<fg=yellow;options=bold>{$label}</>");
                $this->line("<fg=gray>" . $items->implode(', ') . "</>");
            }
        }

        $this->newLine();
        $this->info("Forge: php artisan fabric:component {$library}:{name}");

        return self::SUCCESS;
    }
}
