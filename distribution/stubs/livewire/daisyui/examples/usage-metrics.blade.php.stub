<div class="card bg-base-100 shadow-xl border border-base-200">
    <div class="card-body">
        <h2 class="card-title justify-between">
            {{ __('Usage Metrics') }}
            <div class="badge badge-outline">{{ __('Live') }}</div>
        </h2>
        
        <div class="space-y-6 mt-4">
            @foreach($metrics as $metric)
                <div>
                    <div class="flex justify-between text-sm mb-1 font-medium">
                        <span>{{ $metric['label'] }}</span>
                        <span>{{ $metric['value'] }} / {{ $metric['limit'] }}</span>
                    </div>
                    <progress class="progress progress-{{ $metric['color'] ?? 'primary' }} w-full" value="{{ $metric['value'] }}" max="{{ $metric['limit'] }}"></progress>
                </div>
            @endforeach
        </div>

        <div class="card-actions justify-end mt-6">
            <button class="btn btn-ghost btn-sm">{{ __('View Detailed Logs') }}</button>
            <button class="btn btn-primary btn-sm">{{ __('Upgrade Plan') }}</button>
        </div>
    </div>
</div>
