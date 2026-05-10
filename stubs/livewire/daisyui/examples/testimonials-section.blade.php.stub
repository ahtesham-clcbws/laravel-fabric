<div class="carousel w-full gap-4 p-4">
    @foreach($testimonials as $testimonial)
        <div class="carousel-item w-full md:w-1/2 lg:w-1/3">
            <div class="card bg-base-100 shadow-xl border border-base-200">
                <div class="card-body">
                    <div class="rating rating-sm mb-4">
                        @for($i = 0; $i < 5; $i++)
                            <input type="radio" class="mask mask-star-2 bg-orange-400" @disabled(true) @checked($i < $testimonial['rating']) />
                        @endfor
                    </div>
                    <p class="italic text-base-content/80">"{{ $testimonial['text'] }}"</p>
                    <div class="flex items-center gap-4 mt-6">
                        <div class="avatar">
                            <div class="w-12 rounded-full">
                                <img src="{{ $testimonial['avatar'] }}" />
                            </div>
                        </div>
                        <div>
                            <h4 class="font-bold">{{ $testimonial['name'] }}</h4>
                            <span class="text-xs text-base-content/60">{{ $testimonial['position'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
