<div x-data="{
    activeSlide: 1,
    slides: [],
    init() {
        this.slides = Array.from(this.$refs.container.children);
    },
    next() {
        this.activeSlide = this.activeSlide === this.slides.length ? 1 : this.activeSlide + 1;
    },
    prev() {
        this.activeSlide = this.activeSlide === 1 ? this.slides.length : this.activeSlide - 1;
    }
}" class="relative w-full overflow-hidden rounded-lg">
    <div x-ref="container" class="flex transition-transform duration-500 ease-in-out" :style="{ transform: `translateX(-${(activeSlide - 1) * 100}%)` }">
        {{ $slot }}
    </div>

    <!-- Controls -->
    <button @click="prev()" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/30 p-2 rounded-full hover:bg-white/50">
        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
    </button>
    <button @click="next()" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/30 p-2 rounded-full hover:bg-white/50">
        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
    </button>
</div>
