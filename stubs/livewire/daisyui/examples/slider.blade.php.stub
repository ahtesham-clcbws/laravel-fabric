<div class="carousel w-full rounded-box h-96 relative group">
    @foreach($slides as $index => $slide)
        <div id="slide{{ $index }}" class="carousel-item relative w-full">
            <img src="{{ $slide['image'] }}" class="w-full object-cover" />
            <div class="absolute inset-0 bg-black/30 flex items-center justify-center p-12">
                <div class="text-center text-white max-w-xl">
                    <h2 class="text-4xl font-bold mb-4">{{ $slide['title'] }}</h2>
                    <p class="mb-8 text-lg opacity-90">{{ $slide['description'] }}</p>
                    <button class="btn btn-primary">{{ $slide['button'] ?? __('Learn More') }}</button>
                </div>
            </div>
            <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2 opacity-0 group-hover:opacity-100 transition duration-300">
                <a href="#slide{{ $index == 0 ? count($slides)-1 : $index-1 }}" class="btn btn-circle btn-ghost text-white">❮</a> 
                <a href="#slide{{ $index == count($slides)-1 ? 0 : $index+1 }}" class="btn btn-circle btn-ghost text-white">❯</a>
            </div>
        </div>
    @endforeach
</div>
