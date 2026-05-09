<x-web-layout>
    <x-slot name="title">Testimonials</x-slot>

    <!-- Section 1: Hero -->
    <section class="bg-base-100 py-32 border-b border-base-200">
        <div class="container-1300">
            <div class="max-w-4xl space-y-8">
                <div class="badge badge-primary font-bold uppercase tracking-[0.4em] px-6 py-4 text-[10px]">Social Proof</div>
                <h1 class="text-6xl lg:text-7xl font-bold tracking-tighter leading-[0.9] text-base-content uppercase">
                    Architectural <br/> <span class="text-primary italic">Validation</span>.
                </h1>
                <p class="text-xl text-base-content/60 font-medium italic leading-relaxed max-w-xl">
                    Dispatch logs from industry leaders who have successfully transitioned to the Fabric ecosystem.
                </p>
            </div>
        </div>
    </section>

    <!-- Section 2: Testimonial Wall -->
    <section class="bg-base-100 py-32">
        <div class="container-1300">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 lg:gap-16">
                @foreach([
                    ['name' => 'Julian Thorne', 'role' => 'CTO @ Nexus', 'text' => 'Fabric transformed our architectural velocity. We went from months of scaffolding to a production-ready ecosystem in days.'],
                    ['name' => 'Elena Rivera', 'role' => 'Lead Designer @ Aura', 'text' => 'The Plain Premium standard is a revelation. High-fidelity density without the legacy bloat of CSS frameworks.'],
                    ['name' => 'Marcus Chen', 'role' => 'Founder @ CloudForge', 'text' => 'Mathematical rhythm and cinematic typography. Fabric is the engine for the next generation of web architects.'],
                    ['name' => 'Sara Vance', 'role' => 'Head of Product @ Stripe', 'text' => 'Reliable, scalable, and beautifully engineered. The zero-dependency architecture is a total game-changer for our infra.'],
                    ['name' => 'David Wilson', 'role' => 'Principal Engineer @ Meta', 'text' => 'The high-fidelity dossier mapping allowed us to orchestrate complex data landscapes with surgical precision.'],
                    ['name' => 'Mia Kovic', 'role' => 'Creative Director @ Meta', 'text' => 'A cinematic user experience that loads at the speed of thought. Fabric is the gold standard for performance design.']
                ] as $test)
                    <div class="p-12 bg-base-200/50 rounded-3xl border border-base-200 hover:shadow-2xl transition-all duration-500 hover:-translate-y-4 flex flex-col h-full">
                        <div class="mb-8">
                            <div class="flex gap-1 text-primary">
                                @for($i=0; $i<5; $i++)
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                @endfor
                            </div>
                        </div>
                        <p class="text-2xl font-bold tracking-tight text-base-content leading-relaxed grow italic mb-12">"{{ $test['text'] }}"</p>
                        <div class="flex items-center gap-6 mt-auto">
                            <div class="avatar">
                                <div class="w-14 rounded-2xl bg-base-300">
                                    <img src="https://i.pravatar.cc/100?u={{ $test['name'] }}" class="grayscale hover:grayscale-0 transition-all duration-500" />
                                </div>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold uppercase tracking-tighter">{{ $test['name'] }}</h4>
                                <p class="text-[10px] font-black uppercase tracking-widest text-primary italic">{{ $test['role'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Section 3: Final CTA -->
    <section class="bg-base-100 py-32 border-t border-base-200">
        <div class="container-1300 text-center">
            <div class="max-w-3xl mx-auto space-y-12">
                <h2 class="text-5xl lg:text-7xl font-bold tracking-tighter uppercase leading-tight">
                    Add Your <span class="text-primary italic underline underline-offset-8 decoration-8">Voice</span> <br/> To The Collective.
                </h2>
                <div class="pt-6">
                    <a href="{{ route('contact') }}" class="btn btn-primary rounded-full px-16 h-16 text-lg font-bold uppercase tracking-widest shadow-xl">Join The Matrix</a>
                </div>
            </div>
        </div>
    </section>
</x-web-layout>
