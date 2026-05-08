@props(['variant' => 'default'])

@if($variant === 'glass')
    <div class="card glass w-full shadow-xl">
        <figure><img src="{{ $image }}" alt="{{ $title }}" /></figure>
        <div class="card-body">
            <h2 class="card-title">{{ $title }}</h2>
            <p>{{ $slot }}</p>
            <div class="card-actions justify-end">
                <button class="btn btn-primary">{{ $buttonText ?? __('Learn More') }}</button>
            </div>
        </div>
    </div>

@elseif($variant === 'side')
    <div class="card lg:card-side bg-base-100 shadow-xl border border-base-200">
        <figure class="max-w-xs"><img src="{{ $image }}" alt="{{ $title }}" class="h-full object-cover" /></figure>
        <div class="card-body">
            <h2 class="card-title">{{ $title }}</h2>
            <p>{{ $slot }}</p>
            <div class="card-actions justify-end">
                <button class="btn btn-secondary">{{ $buttonText ?? __('Buy Now') }}</button>
            </div>
        </div>
    </div>

@else
    <div class="card bg-base-100 shadow-xl border border-base-200">
        <figure><img src="{{ $image }}" alt="{{ $title }}" /></figure>
        <div class="card-body">
            <div class="flex justify-between items-start">
                <h2 class="card-title">{{ $title }}</h2>
                @if(isset($badge))
                    <div class="badge badge-secondary">{{ $badge }}</div>
                @endif
            </div>
            <p>{{ $slot }}</p>
            <div class="card-actions justify-end mt-4">
                <button class="btn btn-primary">{{ $buttonText ?? __('Action') }}</button>
            </div>
        </div>
    </div>
@endif
