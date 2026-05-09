<x-web-layout>
    <x-slot name="title">Our Disciplines</x-slot>

    <!-- Section 1: Hero (FDS Compliant) -->
    <section class="bg-base-100 py-32 border-b border-base-200">
        <div class="container-1300">
            <div class="max-w-4xl mx-auto text-center space-y-10">
                <div class="badge badge-primary font-bold uppercase tracking-[0.3em] px-6 py-4 text-[10px]">The Forge Matrix</div>
                <h1 class="text-5xl lg:text-7xl font-bold tracking-tighter leading-[0.9] text-base-content uppercase">
                    High-Fidelity <br/> <span class="text-primary italic">Architectural</span> <br/> Solutions.
                </h1>
                <p class="text-xl text-base-content/60 font-medium italic leading-relaxed max-w-2xl mx-auto">
                    From enterprise infrastructure to cinematic landing landscapes, we forge the digital foundations of the next generation.
                </p>
                <div class="flex justify-center pt-8">
                    <a href="#contact" class="btn btn-primary rounded-full px-12 h-14 font-bold text-sm tracking-widest">Inquire Now</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 2: Services Grid (FDS Cards) -->
    <section class="bg-base-100 py-32 border-b border-base-200">
        <div class="container-1300">
            <div class="mb-16 space-y-4">
                <h2 class="text-4xl lg:text-5xl font-bold tracking-tighter uppercase">Our <span class="text-primary italic">Disciplines</span></h2>
                <p class="text-lg text-base-content/60 font-medium italic">Comprehensive strategy for elite digital presence.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @foreach([
                    ['title' => 'Web Forge', 'icon' => 'code', 'desc' => 'High-performance Laravel & Livewire ecosystems built for zero-friction scale.'],
                    ['title' => 'UI Strategy', 'icon' => 'palette', 'desc' => 'Cinematic design systems that prioritize mathematical rhythm and brand authority.'],
                    ['title' => 'Cloud Matrix', 'icon' => 'cloud', 'desc' => 'Automated deployment pipelines and serverless clusters for global distribution.'],
                    ['title' => 'Data Dossiers', 'icon' => 'database', 'desc' => 'Deep analytics and model orchestration to transform raw data into actionable insight.'],
                    ['title' => 'E-Commerce', 'icon' => 'shopping-bag', 'desc' => 'Conversion-optimized retail landscapes with high-fidelity product storytelling.'],
                    ['title' => 'Elite Support', 'icon' => 'shield', 'desc' => 'Dedicated architectural monitoring and rapid-response maintenance collectives.']
                ] as $service)
                    <div class="group space-y-8 p-10 bg-base-200/50 rounded-3xl border border-base-200 hover:shadow-xl transition-all">
                        <div class="w-16 h-16 bg-primary/10 text-primary rounded-full flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <div class="space-y-4">
                            <h3 class="text-2xl font-bold tracking-tight uppercase">{{ $service['title'] }}</h3>
                            <p class="text-base text-base-content/50 font-medium italic leading-relaxed">
                                {{ $service['desc'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Section 3: Process (FDS Timeline) -->
    <section class="bg-base-200/30 py-32">
        <div class="container-1300">
            <div class="mb-16 space-y-4">
                <h2 class="text-4xl lg:text-5xl font-bold tracking-tighter uppercase">The <span class="text-secondary italic">Orchestration</span></h2>
                <p class="text-lg text-base-content/60 font-medium italic">From initial dispatch to global deployment.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <div class="space-y-6">
                    <div class="text-4xl font-bold text-secondary/30 tracking-tighter">01</div>
                    <h4 class="text-xl font-bold uppercase tracking-tight">Discovery</h4>
                    <p class="text-sm text-base-content/50 font-medium italic">Deep-dive into your architectural requirements and vision.</p>
                </div>
                <div class="space-y-6">
                    <div class="text-4xl font-bold text-secondary/30 tracking-tighter">02</div>
                    <h4 class="text-xl font-bold uppercase tracking-tight">Strategy</h4>
                    <p class="text-sm text-base-content/50 font-medium italic">Forging the blueprint and selecting the elite tech stack.</p>
                </div>
                <div class="space-y-6">
                    <div class="text-4xl font-bold text-secondary/30 tracking-tighter">03</div>
                    <h4 class="text-xl font-bold uppercase tracking-tight">Forging</h4>
                    <p class="text-sm text-base-content/50 font-medium italic">Rapid implementation of high-fidelity components.</p>
                </div>
                <div class="space-y-6">
                    <div class="text-4xl font-bold text-secondary/30 tracking-tighter">04</div>
                    <h4 class="text-xl font-bold uppercase tracking-tight">Launch</h4>
                    <p class="text-sm text-base-content/50 font-medium italic">Zero-downtime deployment to the global production cluster.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 4: Final CTA -->
    <section class="bg-base-100 py-32 border-t border-base-200">
        <div class="container-1300">
            <div class="bg-primary rounded-3xl p-16 lg:p-24 text-center space-y-10 shadow-2xl">
                <h2 class="text-4xl lg:text-6xl font-bold text-white uppercase tracking-tighter leading-tight">
                    Start Your Forge.
                </h2>
                <p class="text-xl text-white/70 max-w-xl mx-auto font-medium italic">
                    Ready to elevate your digital landscape with architectural precision?
                </p>
                <div class="flex justify-center pt-6">
                    <a href="{{ route('contact') }}" class="btn btn-white rounded-full px-12 h-16 text-lg font-bold uppercase tracking-widest shadow-xl">Contact Sales</a>
                </div>
            </div>
        </div>
    </section>
</x-web-layout>
