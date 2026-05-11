@props([
    'text' => ''
])

<div x-data="{ show: false }" class="relative inline-block">
    <div @mouseenter="show = true" @mouseleave="show = false" class="inline-block">
        {{ $slot }}
    </div>

    <div x-show="show" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="absolute z-10 w-32 p-2 mt-1 text-xs text-white bg-gray-900 rounded shadow-lg -translate-x-1/2 left-1/2" style="display: none;">
        {{ $text }}
        <div class="absolute w-2 h-2 bg-gray-900 rotate-45 -translate-x-1/2 left-1/2 -top-1"></div>
    </div>
</div>
