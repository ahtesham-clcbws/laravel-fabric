<x-web-layout>
    <x-slot name="title">{{ $post->title }}</x-slot>

    <!-- Section 1: Article Header -->
    <section class="bg-base-100 py-24 border-b border-base-200">
        <div class="container-1300 max-w-4xl">
            <nav class="text-[10px] font-black uppercase tracking-[0.4em] mb-12 opacity-30">
                <ul class="flex items-center gap-4">
                    <li><a href="{{ route('home') }}" class="hover:text-primary">Home</a></li> 
                    <li>/</li>
                    <li><a href="{{ route('blog.index') }}" class="hover:text-primary">Blog</a></li> 
                    <li>/</li>
                    <li class="text-base-content/100 truncate">{{ $post->title }}</li>
                </ul>
            </nav>

            <header class="space-y-10">
                <div class="badge badge-primary font-bold uppercase tracking-[0.3em] px-6 py-4 text-[10px]">{{ $post->category->name ?? 'Dossier' }}</div>
                <h1 class="text-5xl lg:text-7xl font-bold tracking-tighter leading-[1.1] text-base-content uppercase">{{ $post->title }}</h1>
                
                <div class="flex items-center gap-6 p-8 bg-base-200/50 rounded-3xl border border-base-200">
                    <div class="avatar">
                        <div class="w-16 rounded-full ring ring-primary ring-offset-base-100 ring-offset-4">
                            <img src="{{ asset('assets/images/avatar.png') }}" class="grayscale hover:grayscale-0 transition-all duration-500" />
                        </div>
                    </div>
                    <div>
                        <div class="font-black text-xl uppercase tracking-tight">Fabric Team</div>
                        <div class="text-base-content/40 font-medium italic">Architectural Lead &bull; {{ $post->created_at->format('F d, Y') }}</div>
                    </div>
                </div>
            </header>
        </div>
    </section>

    <!-- Section 2: Article Content -->
    <section class="bg-base-100 py-24">
        <div class="container-1300 max-w-4xl">
            <div class="relative mb-20 group">
                <div class="absolute -inset-4 bg-primary/5 rounded-[3rem] blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-1000"></div>
                <img src="{{ asset($post->featured_image ?? 'assets/images/blog_placeholder.png') }}" class="w-full h-150 object-cover rounded-3xl shadow-2xl relative z-10 grayscale hover:grayscale-0 transition-all duration-1500" />
            </div>

            <article class="prose prose-xl max-w-none prose-headings:font-bold prose-headings:tracking-tighter prose-headings:uppercase prose-p:italic prose-p:font-medium prose-p:text-base-content/60 prose-img:rounded-3xl prose-img:shadow-2xl">
                {!! $post->content !!}
            </article>

            <!-- Social Share (FDS Styled) -->
            <div class="mt-24 pt-12 border-t border-base-200 flex flex-col sm:flex-row items-center justify-between gap-8">
                <h4 class="text-xl font-bold uppercase tracking-widest italic opacity-40">Article Dispatch</h4>
                <div class="flex gap-4">
                    <button class="btn btn-ghost btn-circle border-base-200 hover:bg-primary hover:text-white transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 100-2.684 3 3 0 000 2.684zm0 9a3 3 0 100-2.684 3 3 0 000 2.684z"></path></svg>
                    </button>
                    <button class="btn btn-ghost btn-circle border-base-200 hover:bg-secondary hover:text-white transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    </button>
                </div>
            </div>
        </div>
    </section>
</x-web-layout>
