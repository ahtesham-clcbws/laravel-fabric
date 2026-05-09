<x-web-layout>
    <x-slot name="title">Our Team</x-slot>

    <!-- Section 1: Hero -->
    <section class="bg-base-100 py-32 border-b border-base-200">
        <div class="container-1300 text-center">
            <div class="max-w-4xl mx-auto space-y-8">
                <div class="badge badge-secondary font-bold uppercase tracking-[0.4em] px-6 py-4 text-[10px]">The Collective</div>
                <h1 class="text-6xl lg:text-7xl font-bold tracking-tighter leading-[0.9] text-base-content uppercase">
                    Elite <br/> <span class="text-secondary italic">Architects</span>.
                </h1>
                <p class="text-xl text-base-content/60 font-medium italic leading-relaxed max-w-xl mx-auto">
                    A distributed gathering of engineers, designers, and strategists forging the future of the web.
                </p>
            </div>
        </div>
    </section>

    <!-- Section 2: Team Grid -->
    <section class="bg-base-100 py-32">
        <div class="container-1300">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-20">
                @foreach([
                    ['name' => 'Alex Rivera', 'role' => 'Lead Architect', 'img' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=facearea&facepad=2&w=400&h=400&q=80', 'color' => 'primary'],
                    ['name' => 'Sarah Chen', 'role' => 'Core Strategist', 'img' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=facearea&facepad=2&w=400&h=400&q=80', 'color' => 'secondary'],
                    ['name' => 'Marcus Thorne', 'role' => 'Design Lead', 'img' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=facearea&facepad=2&w=400&h=400&q=80', 'color' => 'accent'],
                    ['name' => 'Elena Vance', 'role' => 'Dev Ops', 'img' => 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=facearea&facepad=2&w=400&h=400&q=80', 'color' => 'neutral'],
                    ['name' => 'James Wilson', 'role' => 'Frontend Forge', 'img' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=facearea&facepad=2&w=400&h=400&q=80', 'color' => 'primary'],
                    ['name' => 'Mia Kovic', 'role' => 'UI Engineer', 'img' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=facearea&facepad=2&w=400&h=400&q=80', 'color' => 'secondary'],
                    ['name' => 'Dante King', 'role' => 'Security Ops', 'img' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=facearea&facepad=2&w=400&h=400&q=80', 'color' => 'accent'],
                    ['name' => 'Sofi Chen', 'role' => 'Growth Lead', 'img' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=facearea&facepad=2&w=400&h=400&q=80', 'color' => 'neutral']
                ] as $member)
                    <div class="text-center group space-y-6">
                        <div class="aspect-square overflow-hidden rounded-full border-4 border-base-200 group-hover:border-{{ $member['color'] }} transition-colors duration-700 shadow-xl">
                            <img src="{{ $member['img'] }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-1000" />
                        </div>
                        <div class="space-y-2">
                            <h4 class="text-xl font-bold uppercase tracking-tight">{{ $member['name'] }}</h4>
                            <p class="text-[10px] font-black uppercase tracking-widest text-{{ $member['color'] }} italic">{{ $member['role'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Section 3: Final CTA -->
    <section class="bg-base-200/50 py-32 border-t border-base-200">
        <div class="container-1300 text-center space-y-10">
            <h2 class="text-4xl lg:text-6xl font-bold tracking-tighter uppercase max-w-2xl mx-auto leading-tight">
                Want to join <br/> the <span class="text-primary italic">Collective</span>?
            </h2>
            <p class="text-xl text-base-content/50 font-medium italic">We are always looking for elite architectural talent.</p>
            <div class="pt-6">
                <a href="{{ route('contact') }}" class="btn btn-outline btn-primary rounded-full px-12 h-16 text-lg font-bold uppercase tracking-widest">Open Positions</a>
            </div>
        </div>
    </section>
</x-web-layout>
