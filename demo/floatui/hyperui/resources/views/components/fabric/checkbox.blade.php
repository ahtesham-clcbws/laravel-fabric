@props([
    'label' => null,
    'id' => null
])

@php
    $id = $id ?? $attributes->whereStartsWith('wire:model')->first() ?? Str::random(8);
@endphp

<div class="flex items-center">
    <input 
        id="{{ $id }}" 
        type="checkbox" 
        {{ $attributes->merge(['class' => 'h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600']) }}
    >
    @if($label)
        <label for="{{ $id }}" class="ml-3 block text-sm font-medium leading-6 text-gray-900">
            {{ $label }}
        </label>
    @endif
</div>
