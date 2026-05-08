<x-web-layout>
    <x-slot name="title">Our Story</x-slot>

    <!-- Header Section -->
    <section class="bg-base-100 py-40 lg:py-64">
        <div class="container-1300">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-32 items-center">
                <div class="space-y-12">
                    <div class="badge badge-primary badge-outline font-black tracking-[0.3em] px-6 py-4 uppercase text-xs">The Fabric Story</div>
                    <h1 class="text-7xl lg:text-9xl font-black tracking-tighter leading-[0.8] text-base-content uppercase">
                        Forging <br/> <span class="text-primary italic">The Future</span> <br/> of Web.
                    </h1>
                    <p class="text-2xl text-base-content/40 leading-relaxed max-w-xl font-medium">
                        We started with a simple mission: to eliminate the friction between a great idea and a production-ready application.
                    </p>
                </div>
                <div class="relative">
                    <div class="absolute -top-20 -right-20 w-80 h-80 bg-primary/10 rounded-full blur-3xl"></div>
                    <img src="{{ asset('assets/images/hero.png') }}" class="rounded-[5rem] shadow-2xl relative z-10 grayscale" />
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="bg-base-200 py-64 border-y border-base-300">
        <div class="container-1300 text-center">
            <h2 class="text-6xl font-black tracking-tighter mb-24 uppercase">Our Core <span class="text-primary italic">Principles</span></h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-20">
                <div class="bg-base-100 p-20 rounded-[4rem] shadow-xl space-y-8">
                    <div class="text-5xl font-black text-primary">01</div>
                    <h3 class="text-3xl font-black tracking-tight uppercase">Precision</h3>
                    <p class="text-base-content/50 font-medium leading-relaxed">Every line of code is forged with mathematical accuracy and architectural integrity.</p>
                </div>
                <div class="bg-base-100 p-20 rounded-[4rem] shadow-xl space-y-8">
                    <div class="text-5xl font-black text-secondary">02</div>
                    <h3 class="text-3xl font-black tracking-tight uppercase">Performance</h3>
                    <p class="text-base-content/50 font-medium leading-relaxed">High-fidelity interfaces that load at the speed of thought, optimized for elite hardware.</p>
                </div>
                <div class="bg-base-100 p-20 rounded-[4rem] shadow-xl space-y-8">
                    <div class="text-5xl font-black text-accent">03</div>
                    <h3 class="text-3xl font-black tracking-tight uppercase">Privacy</h3>
                    <p class="text-base-content/50 font-medium leading-relaxed">Zero-dependency architecture ensures your data remains your property, forever.</p>
                </div>
            </div>
        </div>
    </section>
</x-web-layout>
