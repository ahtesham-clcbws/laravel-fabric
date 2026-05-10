<div class="stats stats-vertical lg:stats-horizontal shadow-xl w-full border border-base-200">
    @foreach($stats as $stat)
        <div class="stat">
            <div class="stat-figure text-{{ $stat['color'] ?? 'primary' }}">
                {!! $stat['icon'] ?? '' !!}
            </div>
            <div class="stat-title">{{ $stat['label'] }}</div>
            <div class="stat-value text-{{ $stat['color'] ?? 'primary' }}">{{ $stat['value'] }}</div>
            <div class="stat-desc text-sm">{{ $stat['description'] ?? '' }}</div>
        </div>
    @endforeach
</div>
