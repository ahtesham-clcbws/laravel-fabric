<?php

return [

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

    'theme' => 'daisyui',

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
    | Forged Resources
    |--------------------------------------------------------------------------
    |
    | This list is automatically maintained by the fabric:generate command.
    |
    */

    'resources' => [
        'category' => [
            'model' => \App\Models\Category::class,
            'route' => 'fabric.category.index',
            'icon' => '📂',
            'group' => 'Resources',
        ],
        'user' => [
            'model' => \App\Models\User::class,
            'route' => 'fabric.user.index',
            'icon' => '👤',
            'group' => 'Core',
        ],
        'post' => [
            'model' => \App\Models\Post::class,
            'route' => 'fabric.post.index',
            'icon' => '📝',
            'group' => 'Resources',
        ],
        'tag' => [
            'model' => \App\Models\Tag::class,
            'route' => 'fabric.tag.index',
            'icon' => '🏷️',
            'group' => 'Resources',
        ],
    ],

];
