<x-web-layout>
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <!-- Title -->
        <div class="max-w-2xl mx-auto text-center mb-16">
            <h1 class="text-4xl font-bold text-gray-800 sm:text-6xl dark:text-white">
                Fabric <span class="text-blue-600">Core</span>
            </h1>
            <p class="mt-4 text-lg text-gray-600 dark:text-neutral-400">
                A high-fidelity component library powered by DaisyUI, Preline, and standard Tailwind CSS.
            </p>

            <!-- Search Bar -->
            <div class="mt-8 relative max-w-md mx-auto">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" id="template-search" class="block w-full ps-10 p-3 bg-white border border-gray-200 rounded-xl text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-800 dark:text-neutral-400" placeholder="Search templates...">
            </div>
        </div>

        <!-- Grid -->
        <div id="templates-grid" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($templates as $template)
                <div class="template-card" data-name="{{ $template }}">
                <a class="group flex flex-col bg-white border border-gray-200 rounded-2xl p-6 hover:shadow-xl transition-all dark:bg-neutral-900 dark:border-neutral-800" href="{{ route('fabric.docs.template', $template) }}">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-neutral-200 group-hover:text-blue-600 transition-colors capitalize">
                            {{ str_replace('-', ' ', $template) }}
                        </h3>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600 transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                    <p class="mt-3 text-sm text-gray-500 dark:text-neutral-500">
                        View high-fidelity components built using the {{ $template }} framework.
                    </p>
                </a>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        document.getElementById('template-search').addEventListener('input', function(e) {
            const term = e.target.value.toLowerCase();
            const cards = document.querySelectorAll('.template-card');
            
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
