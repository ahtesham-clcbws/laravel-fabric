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
        return self::all()[$template] ?? [];
    }

    public static function all(): array
    {
        return [
            'daisyui' => [
                'button',
                'cards',
                'contact',
                'drawer-editor',
                'faq',
                'gallery',
                'hero',
                'input',
                'navbar-mega',
                'omnisearch',
                'order-history',
                'pricing',
                'select',
                'slider',
                'stat-ring',
                'stats-v2',
                'tall-input',
                'testimonials',
                'textarea',
                'timeline',
                'toggle',
                'usage-metrics'
            ],
            'preline' => [
                'advanced-select',
                'alert',
                'avatar-group',
                'input-group',
                'modal',
                'pin-input',
                'progress',
                'stepper',
                'switch',
                'timeline'
            ],
            'hyperui' => [
                'accordion',
                'badge',
                'breadcrumbs',
                'empty-state',
                'file-uploader',
                'input',
                'quantity-input',
                'select',
                'steps',
                'tabs',
                'timeline'
            ],
            'floatui' => [
                'alert',
                'hero-section',
                'modal',
                'pagination'
            ]
        ];
    }
}
