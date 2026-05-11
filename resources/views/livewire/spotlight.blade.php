<div x-data="{ open: @entangle('isOpen') }" 
     x-on:keydown.window.ctrl.k.prevent="open = true" 
     x-on:keydown.window.meta.k.prevent="open = true"
     x-on:keydown.escape="open = false"
     x-show="open" 
     class="fixed inset-0 z-50 overflow-y-auto p-4 sm:p-6 md:p-20" 
     role="dialog" 
     aria-modal="true"
     style="display: none;">
    
    <div x-show="open" 
         x-transition:enter="ease-out duration-300" 
         x-transition:enter-start="opacity-0" 
         x-transition:enter-end="opacity-100" 
         x-transition:leave="ease-in duration-200" 
         x-transition:leave-start="opacity-100" 
         x-transition:leave-end="opacity-0" 
         class="fixed inset-0 bg-neutral-900/60 backdrop-blur-sm transition-opacity"></div>

    <div x-show="open" 
         x-transition:enter="ease-out duration-300" 
         x-transition:enter-start="opacity-0 scale-95" 
         x-transition:enter-end="opacity-100 scale-100" 
         x-transition:leave="ease-in duration-200" 
         x-transition:leave-start="opacity-100 scale-100" 
         x-transition:leave-end="opacity-0 scale-95" 
         class="mx-auto max-w-2xl transform divide-y divide-neutral-100 overflow-hidden rounded-3xl bg-white shadow-2xl ring-1 ring-black ring-opacity-5 transition-all dark:bg-neutral-900 dark:divide-neutral-800">
        
        <div class="relative">
            <svg class="pointer-events-none absolute left-6 top-5 size-5 text-neutral-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
            </svg>
            <input wire:model.live.debounce.200ms="search" 
                   type="text" 
                   class="h-16 w-full border-0 bg-transparent pl-14 pr-4 text-neutral-900 placeholder:text-neutral-400 focus:ring-0 sm:text-sm dark:text-white" 
                   placeholder="Search your ecosystem (Ctrl+K)..." 
                   autofocus>
        </div>

        @if($results->count() > 0)
            <ul class="max-h-96 overflow-y-auto p-4 space-y-2">
                @foreach($results as $result)
                    <li>
                        <a href="{{ route($result['route'], $result['params'] ?? []) }}" class="group flex items-center gap-4 rounded-2xl px-4 py-3 hover:bg-{{ PRIMARY }}/10 transition-all">
                            <div class="size-10 flex items-center justify-center bg-white border border-neutral-100 rounded-xl text-lg shadow-sm group-hover:scale-110 transition-transform dark:bg-neutral-800 dark:border-neutral-700">
                                {{ $result['icon'] }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="text-sm font-bold text-neutral-800 dark:text-white truncate">{{ $result['title'] }}</div>
                                <div class="text-[10px] font-black uppercase tracking-widest text-neutral-400">{{ $result['description'] }}</div>
                            </div>
                            <svg class="size-5 text-neutral-300 group-hover:text-{{ PRIMARY }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                    </li>
                @endforeach
            </ul>
        @elseif($search)
            <div class="p-10 text-center">
                <p class="text-sm text-neutral-500 font-medium italic">No results found for "{{ $search }}"</p>
            </div>
        @else
            <div class="p-10 text-center">
                <p class="text-[10px] font-black uppercase tracking-widest text-neutral-400">Press Esc to close</p>
            </div>
        @endif
    </div>
</div>
