<x-web-layout>
    <x-slot name="title">Our Blog</x-slot>

    <div class="py-24 px-4 lg:px-10 mx-auto container-1300">
        <div class="text-center mb-20 space-y-4">
            <h1 class="text-5xl lg:text-7xl font-bold tracking-tighter">The <span class="text-primary italic underline underline-offset-8">Fabric</span> Blog</h1>
            <p class="text-xl text-base-content/60 font-medium italic max-w-2xl mx-auto">Explore our latest articles, tutorials, and updates from the world of AI-driven development.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
            @forelse(App\Models\Post::where('is_published', true)->latest()->paginate(9) as $post)
                <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all duration-500 border border-base-200 group overflow-hidden flex flex-col h-full rounded-[2.5rem]">
                    <figure class="relative h-64 overflow-hidden">
                        <img src="{{ asset($post->featured_image ?? 'assets/images/blog_placeholder.png') }}" class="group-hover:scale-110 transition-transform duration-700 w-full h-full object-cover" />
                        <div class="absolute top-4 left-4">
                            <div class="badge badge-primary font-bold shadow-lg py-3">{{ $post->category->name ?? 'Update' }}</div>
                        </div>
                    </figure>
                    <div class="card-body grow p-8">
                        <div class="text-xs font-bold text-base-content/40 uppercase tracking-widest mb-2">{{ $post->created_at->format('F d, Y') }}</div>
                        <h3 class="card-title text-2xl font-bold group-hover:text-primary transition-colors leading-tight mb-4">
                            <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                        </h3>
                        <p class="text-base-content/60 line-clamp-3 leading-relaxed mb-6">
                            {{ strip_tags($post->content) }}
                        </p>
                        <div class="mt-auto pt-6 border-t border-base-200 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="avatar">
                                    <div class="w-8 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                        <img src="{{ asset('assets/images/avatar.png') }}" />
                                    </div>
                                </div>
                                <span class="text-sm font-bold opacity-70">Fabric Team</span>
                            </div>
                            <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-ghost btn-sm text-primary font-bold hover:bg-primary/10 px-4">Read →</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-40 text-center">
                    <div class="text-6xl mb-6 text-base-content/20">📰</div>
                    <h3 class="text-2xl font-bold opacity-40 italic">No posts found in the archives.</h3>
                </div>
            @endforelse
        </div>

        <div class="mt-20">
            {{ App\Models\Post::where('is_published', true)->latest()->paginate(9)->links() }}
        </div>
    </div>
</x-web-layout>
