<div x-data="{ open: false }" 
     @keydown.window.ctrl.k.prevent="open = true" 
     @keydown.window.cmd.k.prevent="open = true"
     @keydown.escape.window="open = false"
     x-show="open" 
     x-cloak
     class="fixed inset-0 z-50 overflow-y-auto p-4 sm:p-6 md:p-20" 
     role="dialog" 
     aria-modal="true">
    
    <div x-show="open" x-transition.opacity class="fixed inset-0 bg-base-300/80 backdrop-blur-sm"></div>

    <div x-show="open" x-transition.scale class="mx-auto max-w-xl transform divide-y divide-base-200 overflow-hidden rounded-2xl bg-base-100 shadow-2xl ring-1 ring-base-content/10 transition-all">
        <div class="relative">
            <svg class="pointer-events-none absolute left-4 top-3.5 h-5 w-5 text-base-content/40" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
            </svg>
            <input wire:model.live.debounce.200ms="query" type="text" class="h-12 w-full border-0 bg-transparent pl-11 pr-4 text-base-content placeholder:text-base-content/40 focus:ring-0 sm:text-sm" placeholder="Search resources (Ctrl+K)..." autofocus>
        </div>

        @if(count($results) > 0)
            <ul class="max-h-96 scroll-py-3 overflow-y-auto p-3">
                @foreach($results as $result)
                    <li>
                        <a href="{{ $result['url'] }}" class="group flex cursor-default select-none items-center rounded-xl p-3 hover:bg-primary hover:text-primary-content">
                            <div class="flex h-10 w-10 flex-none items-center justify-center rounded-lg bg-base-200 text-lg group-hover:bg-primary-focus">
                                {{ $result['icon'] }}
                            </div>
                            <div class="ml-4 flex-auto">
                                <p class="text-sm font-medium">{{ $result['title'] }}</p>
                                <p class="text-xs opacity-50">{{ $result['type'] }}</p>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif

        @if($query !== '' && count($results) === 0)
            <div class="px-6 py-14 text-center sm:px-14">
                <p class="text-sm text-base-content/60">No results found for "{{ $query }}".</p>
            </div>
        @endif

        <div class="flex flex-wrap items-center bg-base-200 px-4 py-2.5 text-[10px] uppercase tracking-widest font-bold text-base-content/40">
            Type <kbd class="mx-1 flex h-5 w-5 items-center justify-center rounded bg-base-100 font-sans border shadow-sm">/</kbd> to search, <kbd class="mx-1 flex h-5 w-5 items-center justify-center rounded bg-base-100 font-sans border shadow-sm">esc</kbd> to close.
        </div>
    </div>
</div>
