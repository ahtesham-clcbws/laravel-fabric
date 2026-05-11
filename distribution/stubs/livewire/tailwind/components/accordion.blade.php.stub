@props([
    'title' => ''
])

<div x-data="{ open: false }" class="border-b border-gray-200">
    <button @click="open = !open" class="flex w-full items-center justify-between py-4 text-left text-sm font-medium text-gray-900 focus:outline-none">
        <span>{{ $title }}</span>
        <svg class="h-5 w-5 transform transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
    </button>
    <div x-show="open" x-collapse class="pb-4 text-sm text-gray-500" style="display: none;">
        {{ $slot }}
    </div>
</div>
