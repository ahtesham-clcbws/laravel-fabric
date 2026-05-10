@props([
    'label' => null,
    'hint' => null,
    'icon' => null
])

@php
    $id = $attributes->whereStartsWith('wire:model')->first() ?? Str::random(8);
@endphp

<div class="form-control w-full">
    @if($label)
        <label for="{{ $id }}" class="label">
            <span class="label-text font-semibold">{{ $label }}</span>
        </label>
    @endif

    <div class="relative flex items-center">
        @if($icon)
            <div class="absolute left-4 text-base-content/50">
                {{ $icon }}
            </div>
        @endif
        
        <input 
            id="{{ $id }}" 
            {{ $attributes->merge(['class' => 'input input-bordered w-full h-12 ' . ($icon ? 'pl-12' : '')]) }}
        >
    </div>

    @if($hint)
        <label class="label">
            <span class="label-text-alt text-base-content/40">{{ $hint }}</span>
        </label>
    @endif

    @error($attributes->whereStartsWith('wire:model')->first())
        <label class="label">
            <span class="label-text-alt text-error font-medium">{{ $message }}</span>
        </label>
    @enderror
</div>
