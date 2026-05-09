<x-web-layout>
    @inject('settings', 'App\Settings\GeneralSettings')
    
    <!-- Section 1: Hero -->
    <section class="bg-base-100 border-b border-base-200">
        <div class="container-1300 py-20 lg:py-40">
            <div class="flex flex-col lg:flex-row items-center gap-16 lg:gap-32">
                <div class="w-full lg:w-1/2 space-y-10 text-center lg:text-left">
                    <div class="badge badge-primary font-bold uppercase tracking-widest px-6 py-4 text-[10px] mx-auto lg:mx-0">Public Beta v1.0.0</div>
                    <h1 class="text-5xl lg:text-7xl font-bold tracking-tighter leading-[0.9] text-base-content uppercase">
                        Forge <span class="text-primary italic">Better</span> <br/> Interfaces.
                    </h1>
                    <p class="text-xl lg:text-2xl text-base-content/50 leading-relaxed max-w-lg mx-auto lg:mx-0 font-medium italic">
                        {{ $settings->site_description }} The most advanced scaffolding engine for Laravel.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-6 pt-6 justify-center lg:justify-start">
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg rounded-full px-12 shadow-xl shadow-primary/30 text-lg font-black uppercase tracking-widest">Get Started</a>
                        <a href="{{ route('services.index') }}" class="btn btn-ghost btn-lg rounded-full px-12 text-lg font-bold border border-base-300">Demos</a>
                    </div>
                </div>
                <div class="w-full lg:w-1/2">
                    <div class="relative p-3 bg-base-100 rounded-[3.5rem] shadow-[0_50px_100px_-20px_rgba(0,0,0,0.15)] border border-base-200">
                        <img src="{{ asset('assets/images/hero.png') }}" class="w-full rounded-[3rem] grayscale" />
                    </div>
                </div>
            </div>

            <!-- Trusted By -->
            <div class="mt-32 pt-16 border-t border-base-200 flex flex-col lg:flex-row items-center justify-between gap-12 opacity-30 grayscale font-black uppercase tracking-[0.4em] text-[10px]">
                <span>Global industry leaders</span>
                <div class="flex flex-wrap items-center justify-center gap-16 text-2xl tracking-tighter">
                    <span>Google</span>
                    <span>Meta</span>
                    <span>Stripe</span>
                    <span>Apple</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 2: Stats (Plain Premium - No Cards) -->
    <section class="bg-base-200/50 border-b border-base-300 py-32 lg:py-48">
        <div class="container-1300">
            <div class="grid grid-cols-1 md:grid-cols-3 divide-y md:divide-y-0 md:divide-x divide-base-300">
                <div class="py-12 md:py-0 md:px-12 text-center md:text-left space-y-4">
                    <div class="text-7xl lg:text-8xl font-black tracking-tighter text-base-content leading-none">31.8K</div>
                    <div class="text-sm font-black uppercase tracking-[0.4em] text-primary">Active Users</div>
                    <p class="text-base-content/40 text-lg font-medium italic">Enterprise distribution.</p>
                </div>
                <div class="py-12 md:py-0 md:px-12 text-center md:text-left space-y-4">
                    <div class="text-7xl lg:text-8xl font-black tracking-tighter text-base-content leading-none">4,200</div>
                    <div class="text-sm font-black uppercase tracking-[0.4em] text-secondary">Forged Apps</div>
                    <p class="text-base-content/40 text-lg font-medium italic">Precision engineering.</p>
                </div>
                <div class="py-12 md:py-0 md:px-12 text-center md:text-left space-y-4">
                    <div class="text-7xl lg:text-8xl font-black tracking-tighter text-base-content leading-none">1,200</div>
                    <div class="text-sm font-black uppercase tracking-[0.4em] text-accent">Deployments</div>
                    <p class="text-base-content/40 text-lg font-medium italic">Global cloud matrix.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 3: Blog (Unified Card Design) -->
    <section class="py-32 lg:py-48 bg-base-100">
        <div class="container-1300">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-20 gap-12">
                <div class="space-y-4">
                    <h2 class="text-6xl font-bold tracking-tighter text-base-content">Latest <span class="text-primary italic underline underline-offset-8">Dispatch</span></h2>
                    <p class="text-xl text-base-content/60 font-medium italic max-w-xl">Explore our latest architectural dossiers and ecosystem updates.</p>
                </div>
                <a href="{{ route('blog.index') }}" class="btn btn-outline btn-primary rounded-full px-10 btn-md font-bold text-xs h-14! border-2">Archive</a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 lg:gap-16">
                @forelse(App\Models\Post::where('is_published', true)->latest()->take(3)->get() as $post)
                    <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all duration-500 border border-base-200 group overflow-hidden flex flex-col h-full rounded-[2.5rem]">
                        <figure class="relative h-64 overflow-hidden">
                            <img src="{{ asset($post->featured_image ?? 'assets/images/blog_placeholder.png') }}" class="group-hover:scale-110 transition-transform duration-700 w-full h-full object-cover grayscale group-hover:grayscale-0" />
                            <div class="absolute top-6 left-6">
                                <div class="badge badge-primary font-bold shadow-lg py-4 px-6 rounded-full text-[10px] uppercase tracking-widest">{{ $post->category->name ?? 'Article' }}</div>
                            </div>
                        </figure>
                        <div class="card-body grow p-8">
                            <div class="text-[10px] font-bold text-base-content/40 uppercase tracking-widest mb-4 italic">{{ $post->created_at->format('F d, Y') }}</div>
                            <h3 class="card-title text-2xl font-black group-hover:text-primary transition-colors leading-tight mb-4 uppercase tracking-tighter">
                                <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                            </h3>
                            <p class="text-base-content/50 text-base line-clamp-3 leading-relaxed mb-6 italic font-medium">
                                {{ strip_tags($post->content) }}
                            </p>
                            <div class="mt-auto pt-6 border-t border-base-200 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="avatar">
                                        <div class="w-10 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                            <img src="{{ asset('assets/images/avatar.png') }}" />
                                        </div>
                                    </div>
                                    <span class="text-xs font-black uppercase tracking-widest opacity-40">Fabric Team</span>
                                </div>
                                <a href="{{ route('blog.show', $post->slug) }}" class="text-primary font-black text-[10px] uppercase tracking-[0.3em] flex items-center gap-2 hover:gap-4 transition-all duration-300">
                                    Read →
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-48 text-center opacity-10 font-black italic text-7xl uppercase tracking-[0.8em]">Zero Records</div>
                @endforelse
            </div>
        </div>
    </section>
</x-web-layout>
