<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Architectural Presets
    |--------------------------------------------------------------------------
    |
    | Master profiles for different industry standards.
    |
    */
    'presets' => [
        'saas' => [
            'theme' => 'tailwind',
            'layout' => 'sidebar',
            'features' => ['auditing', 'api', 'acl'],
        ],
        'ecommerce' => [
            'theme' => 'daisyui',
            'layout' => 'bento',
            'features' => ['media', 'seo', 'csv'],
        ],
        'enterprise' => [
            'theme' => 'tailwind',
            'layout' => 'top-nav',
            'features' => ['audit', 'verify', 'sentry'],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Active Design System
    |--------------------------------------------------------------------------
    |
    | Options: 
    |   - 'tailwind' (Utility-first, raw control)
    |   - 'daisyui' (Semantic, Mary-Inspired)
    |   - 'preline' (Enterprise, Corporate)
    |   - 'floatui' (Minimalist, SaaS)
    |   - 'hyperui' (Product-focused)
    |
    */

    'theme' => env('FABRIC_THEME', 'tailwind'),

    /*
    |--------------------------------------------------------------------------
    | Stack Runtime
    |--------------------------------------------------------------------------
    |
    | Options: 'livewire' (Master), 'inertia' (Coming Soon)
    |
    */

    'runtime' => env('FABRIC_RUNTIME', 'livewire'),

    /*
    |--------------------------------------------------------------------------
    | Layout Architecture
    |--------------------------------------------------------------------------
    |
    | Options: 'sidebar', 'top-nav', 'double-sidebar', 'minimalist', 'bento'
    |
    */

    'layout' => env('FABRIC_LAYOUT', 'sidebar'),

    /*
    |--------------------------------------------------------------------------
    | Theme Palettes
    |--------------------------------------------------------------------------
    |
    | Define the primary colors for your components. You can use any 
    | Tailwind-compatible color class (e.g., 'indigo-600', '#4f46e5').
    |
    */

    'palettes' => [
        'primary'   => env('FABRIC_COLOR_PRIMARY', 'indigo-600'),
        'secondary' => env('FABRIC_COLOR_SECONDARY', 'pink-600'),
        'accent'    => env('FABRIC_COLOR_ACCENT', 'cyan-600'),
        'neutral'   => env('FABRIC_COLOR_NEUTRAL', 'gray-800'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Route Configuration
    |--------------------------------------------------------------------------
    |
    | Define the prefix and middleware for your Fabric dashboard.
    | Set prefix to '' if you want the dashboard on the root domain.
    |
    */
    'prefix' => env('FABRIC_PREFIX', 'admin'),
    'middleware' => ['web', 'auth'],

    /*
    |--------------------------------------------------------------------------
    | Output Paths & Namespacing
    |--------------------------------------------------------------------------
    |
    | Define where the forged components should be placed.
    |
    */

    'output' => [
        'livewire' => env('FABRIC_OUTPUT_LIVEWIRE', app_path('Livewire/Fabric')),
        'views'    => env('FABRIC_OUTPUT_VIEWS', resource_path('views/livewire/fabric')),
        'namespace' => env('FABRIC_NAMESPACE_LIVEWIRE', 'App\\Livewire\\Fabric'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Environment Guard
    |--------------------------------------------------------------------------
    |
    | Fabric is a build-time tool and should strictly be used in local or
    | staging environments. List the environments where commands are enabled.
    |
    */

    'env_guard' => ['local', 'staging'],

    /*
    |--------------------------------------------------------------------------
    | Ignored Columns
    |--------------------------------------------------------------------------
    |
    | These columns will be automatically ignored by the Loom engine during
    | introspection. You can also use a .fabricignore file in the root.
    |
    */

    'ignore' => [
        'id',
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at',
    ],

    /*
    |--------------------------------------------------------------------------
    | Shadow Mode (Hybrid Compatibility)
    |--------------------------------------------------------------------------
    | Define per-module adapter overrides. This allows you to use Native Fabric
    | plugins for new modules while maintaining 3rd-party packages for legacy
    | ones. Example: 'School' => ['media' => 'native']
    */
    'shadow_mode' => [
        // 'School' => [
        //     'media' => 'native',
        //     'permissions' => 'native',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Forge Manifest Settings
    |--------------------------------------------------------------------------
    | Default configuration for the 'fabric:forge' batch generation command.
    */
    'forge' => [
        'manifest' => base_path('fabric.json'),
        'strict_nexus' => true,
    ],
];
