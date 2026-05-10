<?php

namespace CLCBWS\Fabric\Registry;

class ComponentRegistry
{
    public static function getTemplates(): array
    {
        return array_keys(self::all());
    }

    public static function getSections(string $template): array
    {
        $sections = self::all()[$template] ?? [];
        
        $dirs = [
            __DIR__ . "/../../stubs/livewire/{$template}/components",
            __DIR__ . "/../../stubs/livewire/{$template}/examples",
            __DIR__ . "/../../stubs/livewire/{$template}/layouts",
        ];

        foreach ($dirs as $dir) {
            if (\Illuminate\Support\Facades\File::isDirectory($dir)) {
                $files = \Illuminate\Support\Facades\File::files($dir);
                foreach ($files as $file) {
                    $sections[] = \str_replace('.blade.php.stub', '', $file->getFilename());
                }
            }
        }

        return \array_unique($sections);
    }

    public static function all(): array
    {
        return [
            'preline' => [
                // Smart Components
                'button', 'alert', 'avatar', 'badge', 'input', 'checkbox', 'radio', 'switch', 'select', 'textarea', 'dropdown', 'modal', 'card', 'tabs', 'tooltip', 'accordion',

                // Examples (Sections)
                'accordion-sections', 'hero-sections', 'feature-sections', 'blog-sections', 'contact-sections', 'faq-sections', 'team-sections', 'footer-sections', 'navbar-sections', 'stats-sections',
                
                // Layouts & Auth
                'layout:sidebar', 'layout:top-nav', 'layout:bento', 'auth:login', 'auth:register', 'user-profiles'
            ],
            'daisyui' => [
                // Smart Components
                'button', 'alert', 'badge', 'checkbox', 'radio', 'toggle', 'input', 'select', 'textarea', 'modal', 'progress', 'stat', 'card', 'avatar', 'breadcrumbs', 'loading', 'steps',

                // Examples
                'navbar-layouts', 'hero-layouts', 'card-layouts', 'footer-layouts', 'admin-sidebar', 'bento-grid',
                
                // Layouts & Auth
                'layout:sidebar', 'layout:top-nav', 'layout:bento', 'layout:minimalist', 'auth:login', 'auth:register', 'auth:profile'
            ],
            'merakiui' => [
                // Smart Components
                'button', 'input', 'alert', 'avatar', 'dropdown', 'modal', 'tabs', 'tooltip',

                // Marketing Sections
                'hero-backgroundimage', 'hero-centercontent', 'hero-image', 'hero-newsletter', 'hero-sideimage',
                'feature-cards', 'feature-grid', 'feature-media',
                'cta-card', 'cta-centered', 'cta-form',
                'contact-form', 'contact-grid', 'contact-map',
                'pricing-centered', 'pricing-popular', 'pricing-simple',
                'testimonial-slider', 'testimonial-grid'
            ],
            'floatui' => [
                // Smart Components
                'button', 'input', 'alert', 'avatar', 'select', 'checkbox',

                // Examples
                'hero-sections', 'feature-sections', 'pricing-sections', 'contact-sections', 'stats-sections', 'footer-sections',
                '404-pages', 'banners', 'testimonials-grid', 'testimonials-slider', 'logo-grids', 'team-sections',
                'login-listed', 'login-google', 'login-grid'
            ],
            'hyperui' => [
                // Smart Components
                'button', 'badge', 'input', 'alert', 'toggle', 'checkbox',

                // Examples
                'hero-sections', 'feature-grids', 'blog-cards', 'product-cards', 'footer-sections', 'navbar-sections',
                'banner-sections', 'cta-sections', 'faq-sections', 'stats-sections', 'team-sections',
                'neobrutalism-alerts', 'neobrutalism-badges', 'neobrutalism-buttons', 'neobrutalism-cards', 'neobrutalism-inputs'
            ],
            'tailwind' => [
                'accordion', 'alert', 'avatar', 'badge', 'button', 'card', 'checkbox', 'input', 'modal', 'select', 'textarea', 'popover', 'progress', 'steps'
            ],
            'shadcn' => [
                'accordion', 'alert', 'alert-dialog', 'aspect-ratio', 'avatar', 'badge', 'breadcrumb', 'button', 'calendar', 'card', 'carousel', 'checkbox', 'collapsible', 'combobox', 'command', 'context-menu', 'data-table', 'date-picker', 'dialog', 'drawer', 'dropdown-menu', 'form', 'hover-card', 'input', 'input-otp', 'label', 'menubar', 'navigation-menu', 'pagination', 'popover', 'progress', 'radio-group', 'resizable', 'scroll-area', 'select', 'separator', 'sheet', 'skeleton', 'slider', 'sonner', 'switch', 'table', 'tabs', 'textarea', 'toast', 'toggle', 'toggle-group', 'tooltip'
            ],
            'tailgrids' => [
                'marketing', 'application', 'ecommerce', 'ecommerce-advanced', 'accordion', 'alert', 'avatar', 'badge', 'button', 'card', 'checkbox', 'chart', 'dropdown', 'input', 'label', 'link', 'list', 'pagination', 'progress', 'select', 'table', 'tabs', 'textarea', 'tooltip'
            ],
        ];
    }
}
