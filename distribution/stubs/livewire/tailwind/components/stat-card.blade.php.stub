@props([
    'label',
    'value',
    'description' => null,
    'trend' => null, // 'up' or 'down'
    'trendValue' => null
])

<div class="rounded-2xl bg-white p-6 shadow-sm border border-gray-100">
    <div class="flex items-center justify-between mb-4">
        <span class="text-sm font-medium text-gray-500 uppercase tracking-wider">{{ $label }}</span>
        @if($trend === 'up')
            <span class="inline-flex items-center rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                ↑ {{ $trendValue }}
            </span>
        @elseif($trend === 'down')
            <span class="inline-flex items-center rounded-full bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20">
                ↓ {{ $trendValue }}
            </span>
        @endif
    </div>
    <div class="flex items-baseline">
        <span class="text-3xl font-bold tracking-tight text-gray-900">{{ $value }}</span>
        @if($description)
            <span class="ml-2 text-sm text-gray-500 italic">{{ $description }}</span>
        @endif
    </div>
</div>
