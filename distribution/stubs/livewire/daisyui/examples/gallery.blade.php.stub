<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    @foreach($images as $image)
        <div class="group relative overflow-hidden rounded-xl bg-base-300 aspect-square">
            <img src="{{ $image['url'] }}" alt="{{ $image['alt'] ?? '' }}" class="object-cover w-full h-full transition duration-500 group-hover:scale-110" />
            <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                <button class="btn btn-circle btn-ghost text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" /></svg>
                </button>
            </div>
        </div>
    @endforeach
</div>
