@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-center py-20">
        <div class="flex items-center gap-4">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="w-12 h-12 flex items-center justify-center rounded-full bg-base-200 text-base-content/20 cursor-not-allowed">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="w-12 h-12 flex items-center justify-center rounded-full bg-base-200 text-base-content/60 hover:bg-primary hover:text-white transition-all shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
                </a>
            @endif

            {{-- Pagination Elements --}}
            <div class="hidden md:flex items-center gap-3">
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span class="w-12 h-12 flex items-center justify-center text-base-content/30 font-black italic">...</span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="w-12 h-12 flex items-center justify-center rounded-full bg-primary text-white font-black shadow-xl shadow-primary/30">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="w-12 h-12 flex items-center justify-center rounded-full bg-base-200 text-base-content/60 font-black hover:bg-base-300 transition-all">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="w-12 h-12 flex items-center justify-center rounded-full bg-base-200 text-base-content/60 hover:bg-primary hover:text-white transition-all shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                </a>
            @else
                <span class="w-12 h-12 flex items-center justify-center rounded-full bg-base-200 text-base-content/20 cursor-not-allowed">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                </span>
            @endif
        </div>
    </nav>
@endif
