<x-web-layout>
    <x-slot name="title">Pricing Plans</x-slot>

    <!-- Section 1: Hero -->
    <section class="bg-base-100 py-32 border-b border-base-200">
        <div class="container-1300 text-center">
            <div class="max-w-4xl mx-auto space-y-8">
                <div class="badge badge-accent font-bold uppercase tracking-[0.4em] px-6 py-4 text-[10px]">Flexible Scale</div>
                <h1 class="text-6xl lg:text-7xl font-bold tracking-tighter leading-[0.9] text-base-content uppercase">
                    Elite <br/> <span class="text-accent italic">Packages</span>.
                </h1>
                <p class="text-xl text-base-content/60 font-medium italic leading-relaxed max-w-xl mx-auto">
                    Architectural precision at every tier of growth. Select the blueprint that matches your vision.
                </p>
            </div>
        </div>
    </section>

    <!-- Section 2: Pricing Grid -->
    <section class="bg-base-200/50 py-32">
        <div class="container-1300">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                @foreach([
                    ['name' => 'Essential', 'price' => '0', 'color' => 'base-content', 'features' => ['1 Project Space', 'Community Access', 'Standard Components', 'Basic Exports']],
                    ['name' => 'Startup', 'price' => '39', 'color' => 'primary', 'popular' => true, 'features' => ['10 Project Spaces', 'Elite Support', 'High-Fidelity Library', 'Custom Domain', 'Dossier Logic']],
                    ['name' => 'Enterprise', 'price' => '99', 'color' => 'secondary', 'features' => ['Unlimited Spaces', 'Dedicated Architect', 'White-label Rights', 'SLA Guarantee', 'Advanced Security']]
                ] as $plan)
                    <div class="flex flex-col bg-base-100 p-12 rounded-3xl border {{ $plan['popular'] ?? false ? 'border-primary ring-4 ring-primary/5 scale-105 relative z-10' : 'border-base-200' }} shadow-xl">
                        @if($plan['popular'] ?? false)
                            <div class="absolute -top-5 left-1/2 -translate-x-1/2">
                                <span class="badge badge-primary py-4 px-8 rounded-full font-black uppercase tracking-widest text-[9px] shadow-xl">Most Popular</span>
                            </div>
                        @endif
                        <h4 class="text-sm font-black uppercase tracking-[0.5em] text-base-content/30">{{ $plan['name'] }}</h4>
                        <div class="mt-8 flex items-baseline gap-2">
                            <span class="text-7xl font-bold tracking-tighter text-base-content">${{ $plan['price'] }}</span>
                            <span class="text-xl font-medium text-base-content/30 italic">/mo</span>
                        </div>
                        <ul class="mt-12 space-y-6 grow">
                            @foreach($plan['features'] as $feature)
                                <li class="flex items-center gap-4 text-base text-base-content/60 font-medium italic">
                                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    {{ $feature }}
                                </li>
                            @endforeach
                        </ul>
                        <div class="mt-12">
                            <a href="#" class="btn {{ $plan['popular'] ?? false ? 'btn-primary shadow-primary/30' : 'btn-ghost border-base-200' }} w-full rounded-full h-14 font-black uppercase tracking-widest text-xs shadow-xl">Get Started</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Section 3: FAQ Snippet -->
    <section class="bg-base-100 py-32 border-t border-base-200">
        <div class="container-1300 text-center">
            <h2 class="text-4xl font-bold tracking-tighter mb-12 uppercase">Frequently Asked <span class="text-accent italic">Queries</span></h2>
            <div class="max-w-2xl mx-auto space-y-4 text-left">
                <div class="collapse collapse-plus bg-base-200/50 rounded-2xl border border-base-200">
                    <input type="radio" name="my-accordion-3" checked="checked" /> 
                    <div class="collapse-title text-xl font-bold uppercase tracking-tight">Can I upgrade at any time?</div>
                    <div class="collapse-content text-base-content/60 font-medium italic">Yes, your ecosystem is built for infinite scale. You can transition between tiers instantly via your control panel.</div>
                </div>
                <div class="collapse collapse-plus bg-base-200/50 rounded-2xl border border-base-200">
                    <input type="radio" name="my-accordion-3" /> 
                    <div class="collapse-title text-xl font-bold uppercase tracking-tight">Is there a free trial?</div>
                    <div class="collapse-content text-base-content/60 font-medium italic">We offer a 14-day high-fidelity trial for all premium plans with zero credit card commitment.</div>
                </div>
            </div>
        </div>
    </section>
</x-web-layout>
