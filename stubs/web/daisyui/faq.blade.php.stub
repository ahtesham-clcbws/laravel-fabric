<x-web-layout>
    <x-slot name="title">Frequently Asked Questions</x-slot>

    <div class="py-24 px-4 lg:px-20 max-w-4xl mx-auto">
        <div class="text-center mb-20">
            <h1 class="text-6xl font-bold tracking-tighter mb-4">Got <span class="text-primary">Questions?</span></h1>
            <p class="text-xl text-base-content/60">Everything you need to know about the product and billing.</p>
        </div>

        <div class="space-y-4">
            @forelse($faqs as $faq)
                <div class="collapse collapse-plus bg-base-100 border border-base-200 shadow-sm rounded-2xl transition-all duration-300 hover:border-primary/50">
                    <input type="radio" name="faq-accordion" {{ $loop->first ? 'checked' : '' }} /> 
                    <div class="collapse-title text-xl font-bold p-6">
                        {{ $faq->question }}
                    </div>
                    <div class="collapse-content p-6 pt-0 text-base-content/70 text-lg leading-relaxed"> 
                        <p>{{ $faq->answer }}</p>
                    </div>
                </div>
            @empty
                <div class="card bg-base-100 border border-base-200 border-dashed p-12 text-center text-base-content/40 italic rounded-2xl">
                    <p>No questions found. Our team is working on them!</p>
                </div>
            @endforelse
        </div>

        <div class="mt-20 card bg-base-200 p-10 rounded-3xl flex-col sm:flex-row items-center justify-between gap-8">
            <div>
                <h2 class="text-3xl font-bold tracking-tighter">Still have questions?</h2>
                <p class="text-base-content/60 mt-2">Can't find the answer you're looking for? Please chat to our friendly team.</p>
            </div>
            <a href="{{ route('contact') }}" class="btn btn-primary rounded-full px-8">Get in Touch</a>
        </div>
    </div>
</x-web-layout>
