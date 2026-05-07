@props([
    'title' => null,
    'footer' => null
])

<div {{ $attributes->merge(['class' => 'overflow-hidden rounded-lg bg-white shadow']) }}>
    @if($title)
        <div class="border-b border-gray-200 px-4 py-5 sm:px-6">
            <h3 class="text-base font-semibold leading-6 text-gray-900">{{ $title }}</h3>
        </div>
    @endif

    <div class="px-4 py-5 sm:p-6">
        {{ $slot }}
    </div>

    @if($footer)
        <div class="bg-gray-50 px-4 py-4 sm:px-6">
            {{ $footer }}
        </div>
    @endif
</div>
