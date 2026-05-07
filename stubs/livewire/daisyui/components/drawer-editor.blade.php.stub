@props([
    'title' => 'Editor',
    'id' => 'editor-drawer'
])

<div class="drawer drawer-end z-50">
    <input id="{{ $id }}" type="checkbox" class="drawer-toggle" @entangle($attributes->wire('model')) />
    <div class="drawer-side">
        <label for="{{ $id }}" aria-label="close sidebar" class="drawer-overlay"></label>
        <div class="menu p-0 w-full max-w-lg min-h-full bg-base-100 text-base-content shadow-2xl">
            <!-- Header -->
            <div class="flex items-center justify-between p-6 border-b border-base-200">
                <h3 class="text-xl font-black uppercase tracking-tighter text-primary">{{ $title }}</h3>
                <label for="{{ $id }}" class="btn btn-sm btn-circle btn-ghost">✕</label>
            </div>

            <!-- Content -->
            <div class="p-6 flex-1 overflow-y-auto">
                {{ $slot }}
            </div>

            <!-- Footer -->
            <div class="p-6 border-t border-base-200 bg-base-200/50 flex justify-end gap-2">
                {{ $footer ?? '' }}
            </div>
        </div>
    </div>
</div>
