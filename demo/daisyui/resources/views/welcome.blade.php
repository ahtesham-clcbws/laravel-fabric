<x-web-layout>
    @inject('settings', 'App\Settings\GeneralSettings')
    
    <!-- Section 1: Hero (Clean White) -->
    <section class="relative bg-base-100 overflow-hidden border-b border-base-200">
        <div class="container-1300 py-48 lg:py-72">
            <div class="flex flex-col lg:flex-row items-center gap-24 lg:gap-56">
                <div class="w-full lg:w-7/12 space-y-20">
                    <div class="inline-flex items-center gap-5 bg-primary/10 border border-primary/20 rounded-full px-10 py-4">
                        <span class="relative flex h-4 w-4">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-4 w-4 bg-primary"></span>
                        </span>
                        <span class="text-sm font-black uppercase tracking-[0.4em] text-primary">Public Beta v1.0.0</span>
                    </div>
                    
                    <h1 class="text-8xl lg:text-[11rem] font-black tracking-tighter leading-[0.75] text-base-content uppercase">
                        Forge <br/> <span class="text-primary italic">Better</span> <br/> Apps.
                    </h1>
                    
                    <p class="text-3xl text-base-content/40 leading-relaxed max-w-2xl font-medium italic">
                        {{ $settings->site_description }} The most advanced scaffolding engine for Laravel developers.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-12 pt-10">
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg rounded-full px-24 shadow-[0_40px_80px_-15px_rgba(var(--p),.6)] text-2xl font-black uppercase tracking-widest h-28">Get Started</a>
                        <a href="{{ route('services.index') }}" class="btn btn-ghost btn-lg rounded-full px-20 text-xl font-black uppercase border-4 border-base-200 h-28">View Demos</a>
                    </div>
                </div>
                
                <div class="w-full lg:w-5/12 relative">
                    <div class="absolute -top-64 -right-64 w-[800px] h-[800px] bg-primary/5 rounded-full blur-[180px]"></div>
                    <div class="relative z-10 p-4 bg-base-100 rounded-[7rem] shadow-[0_100px_200px_-40px_rgba(0,0,0,0.2)] border border-base-200">
                        <img src="{{ asset('assets/images/hero.png') }}" class="w-full rounded-[6rem] grayscale contrast-125" />
                    </div>
                </div>
            </div>

            <!-- Trusted By: Huge Spacing -->
            <div class="mt-72 pt-32 border-t border-base-200">
                <div class="flex flex-col lg:flex-row items-center justify-between gap-32 opacity-20 grayscale">
                    <div class="text-xs font-black uppercase tracking-[0.8em] text-base-content whitespace-nowrap">Global Industry Titans</div>
                    <div class="flex flex-wrap items-center justify-center lg:justify-end gap-x-32 gap-y-20">
                        <span class="text-6xl font-black tracking-tighter">Google</span>
                        <span class="text-6xl font-black tracking-tighter">Meta</span>
                        <span class="text-6xl font-black tracking-tighter">Stripe</span>
                        <span class="text-6xl font-black tracking-tighter">Apple</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 2: Stats (Light Contrast) -->
    <section class="bg-slate-50 py-72 border-b border-base-300">
        <div class="container-1300">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-32">
                <div class="bg-base-100 p-24 rounded-[6rem] shadow-2xl border border-base-200 space-y-12">
                    <div class="w-24 h-24 bg-primary/5 rounded-[3rem] flex items-center justify-center text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle></svg>
                    </div>
                    <div class="space-y-6">
                        <div class="text-9xl font-black tracking-tighter text-base-content">31K</div>
                        <div class="text-sm font-black uppercase tracking-[0.6em] text-primary">Global Elite Users</div>
                    </div>
                </div>
                <div class="bg-base-100 p-24 rounded-[6rem] shadow-2xl border border-base-200 space-y-12">
                    <div class="w-24 h-24 bg-secondary/5 rounded-[3rem] flex items-center justify-center text-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg>
                    </div>
                    <div class="space-y-6">
                        <div class="text-9xl font-black tracking-tighter text-base-content">4.2K</div>
                        <div class="text-sm font-black uppercase tracking-[0.6em] text-secondary">Projects Forged</div>
                    </div>
                </div>
                <div class="bg-base-100 p-24 rounded-[6rem] shadow-2xl border border-base-200 space-y-12">
                    <div class="w-24 h-24 bg-accent/5 rounded-[3rem] flex items-center justify-center text-accent">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path></svg>
                    </div>
                    <div class="space-y-6">
                        <div class="text-9xl font-black tracking-tighter text-base-content">1.2K</div>
                        <div class="text-sm font-black uppercase tracking-[0.6em] text-accent">Elite Deployments</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 3: Blog (Clean White) -->
    <section class="py-72 bg-base-100">
        <div class="container-1300">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end mb-48 gap-24">
                <div class="max-w-3xl">
                    <h2 class="text-[10rem] font-black tracking-tighter leading-[0.8] mb-12 text-base-content uppercase">Latest <br/> <span class="text-primary italic underline underline-offset-[24px]">Dispatch</span></h2>
                    <p class="text-4xl text-base-content/20 font-black italic uppercase tracking-widest">Architectural Dossiers.</p>
                </div>
                <a href="{{ route('blog.index') }}" class="btn btn-outline btn-primary rounded-full px-24 btn-lg h-32 border-4 font-black uppercase tracking-[0.5em] text-sm">Archives</a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-40">
                @forelse(App\Models\Post::where('is_published', true)->latest()->take(3)->get() as $post)
                    <div class="group flex flex-col h-full space-y-16">
                        <a href="{{ route('blog.show', $post->slug) }}" class="block relative aspect-[4/5] overflow-hidden rounded-[7rem] shadow-[0_60px_120px_-30px_rgba(0,0,0,0.2)] border border-base-200">
                            <img src="{{ asset($post->featured_image ?? 'assets/images/blog_placeholder.png') }}" class="group-hover:scale-105 transition-transform duration-[2000ms] w-full h-full object-cover grayscale group-hover:grayscale-0" />
                            <div class="absolute bottom-20 left-20">
                                <div class="badge badge-primary font-black shadow-2xl py-10 px-12 rounded-full text-sm uppercase tracking-[0.5em]">{{ $post->category->name ?? 'Article' }}</div>
                            </div>
                        </a>
                        <div class="space-y-10 px-8">
                            <h3 class="text-6xl font-black leading-tight group-hover:text-primary transition-colors tracking-tighter uppercase">{{ $post->title }}</h3>
                            <p class="text-3xl text-base-content/40 leading-relaxed line-clamp-2 font-medium italic">{{ strip_tags($post->content) }}</p>
                        </div>
                        <a href="{{ route('blog.show', $post->slug) }}" class="mt-auto px-8 text-primary font-black text-sm uppercase tracking-[0.6em] flex items-center gap-8 hover:gap-16 transition-all duration-700">
                            Read Dossier 
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                        </a>
                    </div>
                @empty
                    <div class="col-span-full py-72 text-center opacity-10 font-black italic text-7xl uppercase tracking-[1em]">Empty Matrix</div>
                @endforelse
            </div>
        </div>
    </section>
</x-web-layout>
