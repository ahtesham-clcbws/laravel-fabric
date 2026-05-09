<x-web-layout>
    <x-slot name="title">Service Blueprint</x-slot>

    <!-- Section 1: Hero -->
    <section class="bg-base-100 py-32 border-b border-base-200">
        <div class="container-1300">
            <div class="max-w-4xl space-y-8">
                <div class="badge badge-primary font-bold uppercase tracking-[0.4em] px-6 py-4 text-[10px]">Architectural Discipline</div>
                <h1 class="text-6xl lg:text-7xl font-bold tracking-tighter leading-[0.9] text-base-content uppercase">
                    Service <br/> <span class="text-primary italic">Intelligence</span>.
                </h1>
                <p class="text-xl text-base-content/60 font-medium italic leading-relaxed max-w-xl">
                    Deep-dive into our specialized forge processes and global deployment strategies.
                </p>
            </div>
        </div>
    </section>

    <!-- Section 2: Detailed Specs -->
    <section class="bg-base-100 py-32">
        <div class="container-1300">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-24 items-start">
                <div class="space-y-12">
                    <div class="space-y-6">
                        <h2 class="text-4xl font-bold tracking-tighter uppercase">The <span class="text-primary italic">Process</span></h2>
                        <p class="text-lg text-base-content/60 font-medium italic">How we forge high-fidelity ecosystems from raw blueprints.</p>
                    </div>
                    <div class="prose prose-xl prose-p:italic prose-p:font-medium prose-p:text-base-content/60">
                        <p>Our methodology combines mathematical precision with creative intuition. We begin by mapping your architectural requirements into a high-density JSON dossier.</p>
                        <p>From there, our forge engine orchestrates a suite of zero-dependency blade stubs, optimized for elite performance and global scale.</p>
                    </div>
                    <ul class="space-y-6">
                        @foreach(['Zero-Dependency Architecture', 'Cinematic Visual Standards', 'High-Performance Cloud Logic', 'Advanced Dossier Mapping'] as $feat)
                            <li class="flex items-center gap-4 text-xl font-bold uppercase tracking-tight text-base-content">
                                <div class="w-8 h-8 rounded-full bg-primary/10 text-primary flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                {{ $feat }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="relative group">
                    <div class="p-3 bg-base-100 rounded-3xl shadow-2xl border border-base-200">
                        <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&q=80&w=1200" class="w-full rounded-2xl grayscale group-hover:grayscale-0 transition-all duration-1500" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 3: Final CTA -->
    <section class="bg-base-100 py-32 border-t border-base-200">
        <div class="container-1300">
            <div class="bg-primary rounded-3xl p-16 lg:p-24 text-center space-y-10 shadow-2xl">
                <h2 class="text-4xl lg:text-6xl font-bold text-white uppercase tracking-tighter leading-tight">
                    Inquire For <br/> Dispatch.
                </h2>
                <div class="flex justify-center pt-6">
                    <a href="{{ route('contact') }}" class="btn btn-white rounded-full px-12 h-16 text-lg font-bold uppercase tracking-widest shadow-xl">Contact Architect</a>
                </div>
            </div>
        </div>
    </section>
</x-web-layout>
