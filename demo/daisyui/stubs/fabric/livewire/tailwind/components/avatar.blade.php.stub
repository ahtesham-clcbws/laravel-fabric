@props([
    'src' => null,
    'name' => 'User',
    'size' => 'md'
])

@php
    $sizes = [
        'xs' => 'h-6 w-6',
        'sm' => 'h-8 w-8',
        'md' => 'h-10 w-10',
        'lg' => 'h-12 w-12',
        'xl' => 'h-16 w-16',
    ];

    $sizeClasses = $sizes[$size] ?? $sizes['md'];
@endphp

<div {{ $attributes->merge(['class' => "relative inline-block $sizeClasses rounded-full overflow-hidden bg-gray-100"]) }}>
    @if($src)
        <img class="h-full w-full object-cover" src="{{ $src }}" alt="{{ $name }}">
    @else
        <span class="flex h-full w-full items-center justify-center font-medium text-gray-500 uppercase">
            {{ Str::substr($name, 0, 1) }}
        </span>
    @endif
</div>
