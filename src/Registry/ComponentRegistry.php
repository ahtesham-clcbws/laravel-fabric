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
                'accordion',
                'advanced-select',
                'alert',
                'auth:login',
                'auth:register',
                'avatar-group',
                'dropdown',
                'input-group',
                'input-number',
                'layout:sidebar',
                'modal',
                'pin-input',
                'progress',
                'stepper',
                'switch',
                'tabs',
                'timeline'
            ],
            'hyperui' => [
                'accordion',
                'badge',
                'banner',
                'blog-card',
                'breadcrumbs',
                'cart',
                'details-list',
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
                'contact-section',
                'feature-section',
                'hero-section',
                'modal',
                'newsletter',
                'pagination',
                'pricing-section'
            ]
        ];
    }
}
