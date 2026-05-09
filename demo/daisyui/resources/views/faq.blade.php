<x-web-layout>
    <x-slot name="title">FAQ</x-slot>

    <!-- Section 1: Hero -->
    <section class="bg-base-100 py-32 border-b border-base-200">
        <div class="container-1300">
            <div class="max-w-4xl space-y-8">
                <div class="badge badge-primary font-bold uppercase tracking-[0.4em] px-6 py-4 text-[10px]">Neural Knowledge</div>
                <h1 class="text-6xl lg:text-7xl font-bold tracking-tighter leading-[0.9] text-base-content uppercase">
                    Knowledge <br/> <span class="text-primary italic">Base</span>.
                </h1>
                <p class="text-xl text-base-content/60 font-medium italic leading-relaxed max-w-xl">
                    Answers to the most frequent inquiries regarding the Fabric ecosystem and our architectural process.
                </p>
            </div>
        </div>
    </section>

    <!-- Section 2: FAQ Accordion -->
    <section class="bg-base-100 py-32">
        <div class="container-1300">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-16 lg:gap-24">
                <!-- Sidebar -->
                <div class="space-y-12">
                    <div class="space-y-6">
                        <h2 class="text-4xl font-bold tracking-tighter uppercase">Query <span class="text-primary italic">Clusters</span></h2>
                        <p class="text-lg text-base-content/60 font-medium italic">Select a category to filter the intelligence stream.</p>
                    </div>
                    <div class="flex flex-col gap-4">
                        <button class="btn btn-ghost justify-start rounded-full px-8 text-xs font-black uppercase tracking-widest bg-primary text-white shadow-xl shadow-primary/20">General Ecosystem</button>
                        <button class="btn btn-ghost justify-start rounded-full px-8 text-xs font-black uppercase tracking-widest hover:bg-base-200">Technical Specs</button>
                        <button class="btn btn-ghost justify-start rounded-full px-8 text-xs font-black uppercase tracking-widest hover:bg-base-200">Billing & Scale</button>
                        <button class="btn btn-ghost justify-start rounded-full px-8 text-xs font-black uppercase tracking-widest hover:bg-base-200">Security Protocols</button>
                    </div>
                </div>

                <!-- Accordion -->
                <div class="lg:col-span-2 space-y-6">
                    @foreach([
                        ['q' => 'What is the "Plain Premium" design standard?', 'a' => 'It is our core visual philosophy focusing on mathematical rhythm, cinematic typography, and high-fidelity density without the bloat of traditional UI kits.'],
                        ['q' => 'How does the Fabric generation engine work?', 'a' => 'Fabric parses JSON blueprints to orchestrate full-site deployments, mapping data dossiers to high-performance blade stubs in real-time.'],
                        ['q' => 'Can I use my own custom CSS?', 'a' => 'Absolutely. While we provide a robust FDS v1.0 framework, the engine is zero-dependency and supports any custom vanilla CSS or Tailwind utilities.'],
                        ['q' => 'What are the hardware requirements?', 'a' => 'Our ecosystems are optimized for high-performance 32GB RAM environments but are lightweight enough to run on standard cloud clusters with 2-core CPUs.'],
                        ['q' => 'Do you offer custom architectural audits?', 'a' => 'Yes, our elite architects are available for deep-dive infrastructure audits and performance optimization dispatches.'],
                        ['q' => 'Is my data stored on your servers?', 'a' => 'No. Fabric is a local-first generation engine. Your data dossiers and blueprints remain on your local or private cloud infrastructure.']
                    ] as $faq)
                        <div class="collapse collapse-arrow bg-base-200/50 rounded-3xl border border-base-200 group">
                            <input type="radio" name="faq-accordion" /> 
                            <div class="collapse-title text-2xl font-bold uppercase tracking-tight p-8 group-hover:text-primary transition-colors">
                                {{ $faq['q'] }}
                            </div>
                            <div class="collapse-content px-8 pb-8 text-lg text-base-content/60 font-medium italic leading-relaxed">
                                <p>{{ $faq['a'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Section 3: Final CTA -->
    <section class="bg-base-content text-base-100 py-32">
        <div class="container-1300 text-center space-y-10">
            <h2 class="text-3xl lg:text-5xl font-bold tracking-tight max-w-2xl mx-auto leading-tight italic">
                Still have unanswered <span class="text-primary font-black not-italic underline underline-offset-8 decoration-4">Queries</span>?
            </h2>
            <p class="text-xl opacity-50 font-medium italic">Our neural network is available for direct dispatch 24/7.</p>
            <div class="pt-6 text-center">
                <a href="{{ route('contact') }}" class="btn btn-primary rounded-full px-16 h-16 text-lg font-bold uppercase tracking-widest shadow-xl">Inquire Directly</a>
            </div>
        </div>
    </section>
</x-web-layout>
