<x-web-layout>
    @inject('settings', 'App\Settings\GeneralSettings')
    
    <!-- Section 1: Hero -->
    <section class="bg-base-100 border-b border-base-200">
        <div class="container-1300 py-20 lg:py-40">
            <div class="flex flex-col lg:flex-row items-center gap-16 lg:gap-32">
                <div class="w-full lg:w-1/2 space-y-10">
                    <div class="badge badge-primary font-bold uppercase tracking-widest px-4 py-3 text-[10px]">Public Beta v1.0.0</div>
                    <h1 class="text-6xl lg:text-8xl font-black tracking-tighter leading-none text-base-content uppercase">
                        Forge <span class="text-primary italic">Better</span> <br/> Interfaces.
                    </h1>
                    <p class="text-xl lg:text-2xl text-base-content/50 leading-relaxed max-w-lg font-medium">
                        {{ $settings->site_description }} The ultimate scaffolding engine for high-performance Laravel applications.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-6 pt-6">
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg rounded-full px-12 shadow-xl shadow-primary/30 text-lg font-black uppercase tracking-widest">Get Started</a>
                        <a href="{{ route('services.index') }}" class="btn btn-ghost btn-lg rounded-full px-12 text-lg font-bold border border-base-300">Demos</a>
                    </div>
                </div>
                <div class="w-full lg:w-1/2">
                    <div class="relative p-2 bg-base-100 rounded-[3rem] shadow-2xl border border-base-200">
                        <img src="{{ asset('assets/images/hero.png') }}" class="w-full rounded-[2.5rem] grayscale" />
                    </div>
                </div>
            </div>

            <!-- Trusted By -->
            <div class="mt-32 pt-16 border-t border-base-200 flex flex-col lg:flex-row items-center justify-between gap-12 opacity-30 grayscale font-black uppercase tracking-[0.3em] text-[10px]">
                <span>Trusted by industry leaders</span>
                <div class="flex flex-wrap items-center justify-center gap-12 text-2xl">
                    <span>Google</span>
                    <span>Meta</span>
                    <span>Stripe</span>
                    <span>Apple</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 2: Stats -->
    <section class="bg-base-200 py-32">
        <div class="container-1300">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="bg-base-100 p-12 rounded-[2.5rem] shadow-xl border border-base-300 space-y-6">
                    <div class="text-5xl font-black tracking-tighter text-base-content">31.8K</div>
                    <div class="text-xs font-bold uppercase tracking-widest text-primary">Active Users</div>
                    <p class="text-base-content/50 text-sm font-medium">Enterprise scale distribution.</p>
                </div>
                <div class="bg-base-100 p-12 rounded-[2.5rem] shadow-xl border border-base-300 space-y-6">
                    <div class="text-5xl font-black tracking-tighter text-base-content">4,200</div>
                    <div class="text-xs font-bold uppercase tracking-widest text-secondary">Projects Forged</div>
                    <p class="text-base-content/50 text-sm font-medium">Precision engineering.</p>
                </div>
                <div class="bg-base-100 p-12 rounded-[2.5rem] shadow-xl border border-base-300 space-y-6">
                    <div class="text-5xl font-black tracking-tighter text-base-content">1,200</div>
                    <div class="text-xs font-bold uppercase tracking-widest text-accent">Deployments</div>
                    <p class="text-base-content/50 text-sm font-medium">Global cloud matrix.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 3: Blog -->
    <section class="py-32 bg-base-100">
        <div class="container-1300">
            <div class="flex flex-col md:flex-row justify-between items-end mb-20 gap-8">
                <div>
                    <h2 class="text-5xl lg:text-6xl font-black tracking-tighter leading-none mb-6 uppercase text-base-content">Latest <span class="text-primary italic">Dispatch</span></h2>
                    <p class="text-xl text-base-content/40 font-bold uppercase tracking-widest italic">Architectural Dossiers.</p>
                </div>
                <a href="{{ route('blog.index') }}" class="btn btn-outline btn-primary rounded-full px-10 btn-lg font-bold uppercase tracking-widest text-xs">Archives</a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                @forelse(App\Models\Post::where('is_published', true)->latest()->take(3)->get() as $post)
                    <div class="group space-y-8">
                        <a href="{{ route('blog.show', $post->slug) }}" class="block relative aspect-[4/3] overflow-hidden rounded-[2.5rem] shadow-xl border border-base-200">
                            <img src="{{ asset($post->featured_image ?? 'assets/images/blog_placeholder.png') }}" class="group-hover:scale-105 transition-transform duration-1000 w-full h-full object-cover grayscale group-hover:grayscale-0" />
                            <div class="absolute bottom-6 left-6">
                                <div class="badge badge-primary font-bold shadow-lg py-4 px-6 rounded-full text-[10px] uppercase tracking-widest">{{ $post->category->name ?? 'Article' }}</div>
                            </div>
                        </a>
                        <div class="space-y-4">
                            <h3 class="text-3xl font-black leading-tight group-hover:text-primary transition-colors tracking-tighter uppercase">{{ $post->title }}</h3>
                            <p class="text-base-content/40 text-lg line-clamp-2 font-medium italic">{{ strip_tags($post->content) }}</p>
                        </div>
                        <a href="{{ route('blog.show', $post->slug) }}" class="text-primary font-bold text-xs uppercase tracking-widest flex items-center gap-3 hover:gap-6 transition-all duration-300">
                            Read Dossier 
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                        </a>
                    </div>
                @empty
                    <div class="col-span-full py-40 text-center opacity-10 font-black italic text-4xl uppercase tracking-widest">No Data</div>
                @endforelse
            </div>
        </div>
    </section>
</x-web-layout>
