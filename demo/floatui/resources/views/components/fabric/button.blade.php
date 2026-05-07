@props([
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'button'
])

@php
    $baseClasses = 'inline-flex items-center border font-semibold rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150';
    
    $variants = [
        'primary'   => 'border-transparent text-white bg-indigo-600 hover:bg-indigo-600 focus:ring-indigo-600',
        'secondary' => 'border-transparent text-white bg-pink-600 hover:bg-pink-600 focus:ring-pink-600',
        'neutral'   => 'border-transparent text-white bg-gray-800 hover:bg-gray-800 focus:ring-gray-800',
        'accent'    => 'border-transparent text-white bg-cyan-600 hover:bg-cyan-600 focus:ring-cyan-600',
        'success'   => 'border-transparent text-white bg-green-600 hover:bg-green-700 focus:ring-green-500',
        'info'      => 'border-transparent text-white bg-indigo-600 hover:bg-indigo-600 focus:ring-indigo-600',
        'warning'   => 'border-transparent text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-yellow-400',
        'error'     => 'border-transparent text-white bg-red-600 hover:bg-red-700 focus:ring-red-500',
        'ghost'     => 'border-transparent text-gray-600 bg-transparent hover:bg-gray-100 focus:ring-gray-200',
        'outline'   => 'border-gray-300 text-gray-700 bg-white hover:bg-gray-50 focus:ring-indigo-600',
    ];

    $sizes = [
        'xs' => 'px-2 py-1 text-xs',
        'sm' => 'px-3 py-1.5 text-sm',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-5 py-2.5 text-base',
        'xl' => 'px-6 py-3 text-lg',
    ];

    $classes = $baseClasses . ' ' . $variants[$variant] . ' ' . $sizes[$size];
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>
