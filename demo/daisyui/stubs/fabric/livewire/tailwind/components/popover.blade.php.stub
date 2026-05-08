@props([
    'trigger' => null,
    'title' => null
])

<div x-data="{ open: false }" class="relative inline-block">
    <div @click="open = !open" class="cursor-pointer">
        {{ $trigger }}
    </div>

    <div 
        x-show="open" 
        x-transition:enter="transition ease-out duration-200" 
        x-transition:enter-start="opacity-0 translate-y-1" 
        x-transition:enter-end="opacity-100 translate-y-0"
        @click.outside="open = false"
        class="absolute z-50 w-72 mt-2 bg-white rounded-lg shadow-xl ring-1 ring-black ring-opacity-5 origin-top-left left-0"
        style="display: none;"
    >
        @if($title)
            <div class="px-4 py-3 border-b border-gray-100">
                <h3 class="text-sm font-semibold text-gray-900">{{ $title }}</h3>
            </div>
        @endif
        <div class="px-4 py-3 text-sm text-gray-600">
            {{ $slot }}
        </div>
        <div class="absolute w-3 h-3 bg-white rotate-45 border-l border-t border-gray-100 -top-1.5 left-4"></div>
    </div>
</div>
