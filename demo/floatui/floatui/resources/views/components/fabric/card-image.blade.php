@props([
    'image' => null,
    'title' => null,
    'badge' => null
])

<div {{ $attributes->merge(['class' => 'flex flex-col overflow-hidden rounded-xl bg-white shadow-lg transition hover:shadow-xl']) }}>
    @if($image)
        <div class="relative h-48 w-full overflow-hidden">
            <img class="h-full w-full object-cover" src="{{ $image }}" alt="{{ $title }}">
            @if($badge)
                <div class="absolute top-4 right-4">
                    {{ $badge }}
                </div>
            @endif
        </div>
    @endif

    <div class="flex flex-1 flex-col p-6">
        @if($title)
            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $title }}</h3>
        @endif
        
        <div class="flex-1 text-sm text-gray-600">
            {{ $slot }}
        </div>

        <div class="mt-6 flex items-center gap-4">
            {{ $footer ?? '' }}
        </div>
    </div>
</div>
