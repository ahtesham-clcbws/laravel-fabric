<div x-data="{ open: false }" 
     @keydown.window.ctrl.k.prevent="open = true" 
     @keydown.window.cmd.k.prevent="open = true"
     class="relative">
    
    <!-- Trigger Button (Visible in Navbar) -->
    <button @click="open = true" class="btn btn-ghost btn-sm gap-2 border border-base-300 px-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
        <span class="hidden lg:inline text-xs opacity-50">{{ __('Search...') }}</span>
        <kbd class="kbd kbd-xs hidden lg:flex">⌘K</kbd>
    </button>

    <!-- Modal Backdrop -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click.away="open = false"
         @keydown.escape.window="open = false"
         class="fixed inset-0 z-[100] flex items-start justify-center pt-[10vh] bg-base-content/20 backdrop-blur-sm p-4">
        
        <!-- Search Box -->
        <div class="bg-base-100 w-full max-w-2xl rounded-2xl shadow-2xl overflow-hidden border border-base-300">
            <div class="p-4 border-b border-base-300 flex items-center gap-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                <input wire:model.live="query" 
                       type="text" 
                       class="w-full bg-transparent border-none focus:ring-0 text-lg placeholder:text-base-content/40" 
                       placeholder="{{ __('Search resources, actions, or help...') }}"
                       autofocus />
                <button @click="open = false" class="btn btn-ghost btn-xs">{{ __('ESC') }}</button>
            </div>

            <!-- Results Area -->
            <div class="max-h-[60vh] overflow-y-auto p-2">
                @if(empty($results))
                    <div class="px-3 py-12 text-center opacity-40">
                        <div class="text-4xl mb-4">🔍</div>
                        <p>{{ __('Start typing to search...') }}</p>
                    </div>
                @else
                    <div class="px-3 py-2 text-xs font-bold text-base-content/50 uppercase">{{ __('Search Results') }}</div>
                    <div class="space-y-1">
                        @foreach($results as $result)
                            <a href="{{ route($result['route']) }}" class="flex items-center gap-4 px-4 py-3 hover:bg-base-200 rounded-xl transition group">
                                <div class="w-10 h-10 bg-primary/10 text-primary flex items-center justify-center rounded-lg">{{ $result['icon'] }}</div>
                                <div class="flex-1">
                                    <div class="font-bold">{{ $result['title'] }}</div>
                                    <div class="text-xs opacity-60">{{ $result['description'] }}</div>
                                </div>
                                <div class="opacity-0 group-hover:opacity-100 text-xs">Enter ↵</div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Footer -->
            <div class="p-4 bg-base-200 border-t border-base-300 flex gap-6 text-[10px] uppercase font-bold opacity-60">
                <span class="flex gap-1"><kbd class="kbd kbd-xs">↵</kbd> Select</span>
                <span class="flex gap-1"><kbd class="kbd kbd-xs">↑↓</kbd> Navigate</span>
                <span class="flex gap-1"><kbd class="kbd kbd-xs">ESC</kbd> Close</span>
            </div>
        </div>
    </div>
</div>
