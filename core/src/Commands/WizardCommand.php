<?php

declare(strict_types=1);

namespace CLCBWS\Fabric\Commands;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use CLCBWS\Fabric\Facades\Fabric;
use Illuminate\Console\Command;
use function Laravel\Prompts\select;
use function Laravel\Prompts\text;
use function Laravel\Prompts\confirm;
use function Laravel\Prompts\info;
use function Laravel\Prompts\intro;
use function Laravel\Prompts\outro;

class WizardCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'fabric:wizard';

    /**
     * The console command description.
     */
    protected $description = 'Interactive wizard to forge high-fidelity resources';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        intro('🎨 Laravel Fabric Wizard');

        $model = text(
            label: 'Which Model should we forge?',
            placeholder: 'e.g. User, Product, Order',
            required: true
        );

        $mode = select(
            label: 'Forging Mode',
            options: [
                'manual' => 'Manual (Full Control)',
                'preset' => 'Architectural Preset (Industry Standard)',
            ],
            default: 'manual'
        );

        if ($mode === 'preset') {
            $preset = select(
                label: 'Choose a Preset Profile',
                options: [
                    'saas' => 'SaaS (Sidebar, API, ACL, Auditing)',
                    'ecommerce' => 'E-Commerce (Bento, Media, SEO, CSV)',
                    'enterprise' => 'Enterprise (Top-Nav, Audit, Sentry)',
                ]
            );

            $config = \config("fabric.presets.{$preset}");
            $theme = $config['theme'];
            $layout = $config['layout'];
        } else {
            $theme = select(
                label: 'Choose your Design System',
                options: [
                    'tailwind' => 'Tailwind Raw (Utility-first)',
                    'daisyui'  => 'DaisyUI (Semantic/Modern)',
                    'preline'  => 'Preline UI (Enterprise)',
                    'floatui'  => 'Float UI (Minimalist SaaS)',
                    'hyperui'  => 'HyperUI (Product/Creative)',
                ],
                default: \config('fabric.theme', 'tailwind')
            );

            $layout = select(
                label: 'Choose your Layout Architecture',
                options: [
                    'sidebar'        => 'Sidebar (Standard Dashboard)',
                    'top-nav'        => 'Top Navigation (Minimal)',
                    'double-sidebar' => 'Double Sidebar (Data Heavy)',
                    'bento'          => 'Bento Grid (Modern)',
                    'minimalist'     => 'Minimalist (Clean)',
                ],
                default: \config('fabric.layout', 'sidebar')
            );
        }

        if (!confirm("Are you ready to forge the {$model} resource using the {$theme} theme?")) {
            outro('Forging cancelled.');
            return;
        }

        $this->components->info("Forging your destiny...");

        try {
            Fabric::generate($model, [
                'theme' => $theme,
                'layout' => $layout,
            ]);

            $this->info("✨ Success! Your resource is forged.");
            outro("Visit your browser to see the results.");
        } catch (\Exception $e) {
            $this->error("Forging failed: " . $e->getMessage());
        }
    }
}
