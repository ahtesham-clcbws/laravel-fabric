<?php

namespace CLCBWS\Fabric\Engines;

use Illuminate\Support\Str;

readonly class Alchemist
{
    public function __construct(
        protected Guard $guard
    ) {}

    /**
     * Transmute raw HTML/Blade into a dynamic Fabric Stub.
     */
    public function transmute(string $content, string $modelName): string
    {
        $this->guard->enforce();
        
        $modelLower = Str::lower($modelName);
        $modelCamel = Str::camel($modelName);
        $modelSnake = Str::snake($modelName);
        $modelPlural = Str::plural($modelCamel);

        // Replace Model References
        $content = str_replace($modelName, '{{ MODEL_NAME }}', $content);
        $content = str_replace($modelLower, '{{ MODEL_VARIABLE }}', $content); // Heuristic
        $content = str_replace($modelCamel, '{{ MODEL_VARIABLE }}', $content);
        $content = str_replace($modelSnake, '{{ MODEL_SNAKE }}', $content);
        $content = str_replace($modelPlural, '{{ MODEL_PLURAL }}', $content);

        // Replace Color References (Heuristic for common Tailwind colors)
        $content = preg_replace('/indigo-[0-9]{3}/', '{{ PRIMARY }}', $content);
        $content = preg_replace('/gray-[0-9]{3}/', '{{ SECONDARY }}', $content);

        // Replace Wire:model patterns
        $content = preg_replace('/wire:model(\.blur|\.live)?="[^"]+"/', 'wire:model$1="form.{{ FIELD_NAME }}"', $content);

        return $content;
    }
}
