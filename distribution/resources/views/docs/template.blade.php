<x-web-layout>
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <!-- Breadcrumb -->
        <nav class="mb-12" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 text-sm text-gray-500">
                <li><a href="{{ route('fabric.docs.index') }}" class="hover:text-blue-600 transition-colors">Docs</a></li>
                <li>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </li>
                <li class="font-medium text-gray-800 dark:text-neutral-200 capitalize">{{ $template }}</li>
            </ol>
        </nav>

        <div class="mb-16 flex flex-col md:flex-row md:items-end md:justify-between gap-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white capitalize">
                    {{ $template }} <span class="text-blue-600">Framework</span>
                </h1>
                <p class="mt-2 text-gray-600 dark:text-neutral-400">
                    Browse through the core UI sections normalized for the {{ $template }} design system.
                </p>
            </div>
            
            <div class="relative max-w-xs w-full">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" id="section-search" class="block w-full ps-10 p-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-800 dark:text-neutral-400" placeholder="Filter components...">
            </div>
        </div>

        <div id="sections-grid" class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($sections as $section)
                <div class="section-card" data-name="{{ $section }}">
                <a class="group bg-white border border-gray-200 rounded-xl overflow-hidden hover:border-blue-500 transition-all dark:bg-neutral-900 dark:border-neutral-800" href="{{ route('fabric.docs.component', [$template, $section]) }}">
                    <div class="p-5">
                        <h4 class="text-md font-semibold text-gray-800 dark:text-neutral-200 group-hover:text-blue-600 transition-colors capitalize">
                            {{ str_replace('-', ' ', $section) }}
                        </h4>
                        <p class="mt-1 text-xs text-gray-500 dark:text-neutral-500">
                            fabric:{{ $template }}:{{ $section }}
                        </p>
                    </div>
                </a>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        document.getElementById('section-search').addEventListener('input', function(e) {
            const term = e.target.value.toLowerCase();
            const cards = document.querySelectorAll('.section-card');
            
            cards.forEach(card => {
                const name = card.getAttribute('data-name').toLowerCase();
                if (name.includes(term)) {
                    card.classList.remove('hidden');
                } else {
                    card.classList.add('hidden');
                }
            });
        });
    </script>
</x-web-layout>
