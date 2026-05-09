<x-web-layout>
    <x-slot name="title">Contact Us</x-slot>

    <!-- Section 1: Hero -->
    <section class="bg-base-100 py-32 border-b border-base-200">
        <div class="container-1300">
            <div class="max-w-4xl space-y-8">
                <div class="badge badge-primary font-bold uppercase tracking-[0.4em] px-6 py-4 text-[10px]">Open Dispatch</div>
                <h1 class="text-6xl lg:text-7xl font-bold tracking-tighter leading-[0.9] text-base-content uppercase">
                    Initialize <br/> <span class="text-primary italic">Communication</span>.
                </h1>
                <p class="text-xl text-base-content/60 font-medium italic leading-relaxed max-w-xl">
                    Reach out to the collective for architectural inquiries, ecosystem support, or global partnerships.
                </p>
            </div>
        </div>
    </section>

    <!-- Section 2: Contact Portal -->
    <section class="bg-base-100 py-32">
        <div class="container-1300">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-24">
                <!-- Info Column -->
                <div class="space-y-16">
                    <div class="space-y-6">
                        <h2 class="text-4xl font-bold tracking-tighter uppercase">Direct <span class="text-primary italic">Channels</span></h2>
                        <p class="text-lg text-base-content/60 font-medium italic">Our neural network is always online.</p>
                    </div>

                    <div class="space-y-12">
                        <div class="flex items-start gap-8">
                            <div class="w-14 h-14 bg-base-200 rounded-full flex items-center justify-center text-primary shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-xs font-black uppercase tracking-widest text-base-content/30 mb-2">Email Dispatch</h4>
                                <p class="text-2xl font-bold tracking-tight">forge@fabric.dev</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-8">
                            <div class="w-14 h-14 bg-base-200 rounded-full flex items-center justify-center text-secondary shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-xs font-black uppercase tracking-widest text-base-content/30 mb-2">Global HQ</h4>
                                <p class="text-2xl font-bold tracking-tight">Silicon Valley, <br/> CA 94025</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Column -->
                <div class="p-12 bg-base-200/50 rounded-3xl border border-base-200 shadow-2xl">
                    <form action="#" class="space-y-8">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest opacity-40 ml-4">Full Identity</label>
                            <input type="text" placeholder="ALEX RIVERA" class="input input-lg w-full rounded-full bg-base-100 border-base-200 focus:border-primary font-bold uppercase tracking-tight text-sm px-8" />
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest opacity-40 ml-4">Dispatch Address</label>
                            <input type="email" placeholder="ALEX@FABRIC.DEV" class="input input-lg w-full rounded-full bg-base-100 border-base-200 focus:border-primary font-bold uppercase tracking-tight text-sm px-8" />
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest opacity-40 ml-4">Communication</label>
                            <textarea placeholder="HOW CAN WE ASSIST IN YOUR ARCHITECTURAL DISPATCH?" class="textarea textarea-lg w-full rounded-4xl bg-base-100 border-base-200 focus:border-primary font-bold uppercase tracking-tight text-sm p-8 min-h-50"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-full rounded-full h-16 font-black uppercase tracking-widest text-xs shadow-xl shadow-primary/20">Send Dispatch</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-web-layout>
