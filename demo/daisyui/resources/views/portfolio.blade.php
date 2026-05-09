<x-web-layout>
    <x-slot name="title">Portfolio</x-slot>

    <!-- Section 1: Hero -->
    <section class="bg-base-100 py-32 border-b border-base-200">
        <div class="container-1300">
            <div class="max-w-4xl space-y-8">
                <div class="badge badge-primary font-bold uppercase tracking-[0.4em] px-6 py-4 text-[10px]">Case Studies</div>
                <h1 class="text-6xl lg:text-7xl font-bold tracking-tighter leading-[0.9] text-base-content uppercase">
                    Architectural <br/> <span class="text-primary italic">Dossiers</span>.
                </h1>
                <p class="text-xl text-base-content/60 font-medium italic leading-relaxed max-w-xl">
                    A selection of high-fidelity ecosystems forged for industry leaders and visionary disruptors.
                </p>
            </div>
        </div>
    </section>

    <!-- Section 2: Portfolio Grid -->
    <section class="bg-base-100 py-32">
        <div class="container-1300">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 lg:gap-24">
                @foreach([
                    ['title' => 'Nexus Global Platform', 'cat' => 'Fintech', 'img' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&q=80&w=800'],
                    ['title' => 'Cloud AI Orchestrator', 'cat' => 'SAAS', 'img' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&q=80&w=800'],
                    ['title' => 'Retail Forge 2.0', 'cat' => 'E-Commerce', 'img' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&q=80&w=800'],
                    ['title' => 'Digital Identity Suite', 'cat' => 'Security', 'img' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?auto=format&fit=crop&q=80&w=800']
                ] as $project)
                    <div class="group space-y-10">
                        <a href="#" class="block relative aspect-4/5 overflow-hidden rounded-3xl shadow-2xl border border-base-200">
                            <img src="{{ $project['img'] }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-1500" />
                            <div class="absolute bottom-10 left-10">
                                <div class="badge badge-primary font-bold shadow-2xl py-6 px-8 rounded-full text-[10px] uppercase tracking-widest">{{ $project['cat'] }}</div>
                            </div>
                        </a>
                        <div class="space-y-4 px-4">
                            <h3 class="text-3xl font-bold tracking-tighter uppercase text-base-content group-hover:text-primary transition-colors leading-tight">{{ $project['title'] }}</h3>
                            <p class="text-lg text-base-content/40 font-medium italic leading-relaxed">Transforming complex infrastructure into a cinematic user experience.</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Section 3: Final CTA -->
    <section class="bg-base-100 py-32 border-t border-base-200">
        <div class="container-1300">
            <div class="bg-secondary rounded-3xl p-16 lg:p-24 text-center space-y-10 shadow-2xl">
                <h2 class="text-4xl lg:text-6xl font-bold text-white uppercase tracking-tighter leading-tight">
                    Your Vision, <br/> Forged.
                </h2>
                <p class="text-xl text-white/70 max-w-xl mx-auto font-medium italic">
                    Ready to build your next high-fidelity ecosystem? Let's begin the orchestration.
                </p>
                <div class="flex justify-center pt-6">
                    <a href="{{ route('contact') }}" class="btn btn-white rounded-full px-12 h-16 text-lg font-bold uppercase tracking-widest shadow-xl">Start Project</a>
                </div>
            </div>
        </div>
    </section>
</x-web-layout>
