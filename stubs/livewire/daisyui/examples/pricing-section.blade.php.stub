<div class="grid grid-cols-1 md:grid-cols-3 gap-8 w-full">
    @foreach($plans as $plan)
        <div class="card bg-base-100 shadow-xl border {{ $plan['featured'] ? 'border-primary border-2 scale-105' : 'border-base-200' }} relative">
            @if($plan['featured'])
                <div class="badge badge-primary absolute -top-3 left-1/2 -translate-x-1/2">{{ __('Most Popular') }}</div>
            @endif
            <div class="card-body items-center text-center">
                <h2 class="card-title text-2xl">{{ $plan['name'] }}</h2>
                <div class="my-4">
                    <span class="text-4xl font-extrabold">{{ $plan['price'] }}</span>
                    <span class="text-base-content/60">/{{ $plan['period'] }}</span>
                </div>
                <p class="text-sm text-base-content/70 mb-6">{{ $plan['description'] }}</p>
                <ul class="space-y-3 mb-8 text-left w-full">
                    @foreach($plan['features'] as $feature)
                        <li class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                            <span>{{ $feature }}</span>
                        </li>
                    @endforeach
                </ul>
                <div class="card-actions w-full">
                    <button class="btn {{ $plan['featured'] ? 'btn-primary' : 'btn-outline' }} w-full">{{ $plan['buttonText'] }}</button>
                </div>
            </div>
        </div>
    @endforeach
</div>
