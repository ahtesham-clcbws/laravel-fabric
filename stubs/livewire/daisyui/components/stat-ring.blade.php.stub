@props([
    'label',
    'value',
    'progress' => 0,
    'color' => 'primary'
])

<div class="stat bg-base-100 border border-base-200 rounded-box shadow-sm">
    <div class="stat-figure text-{{ $color }}">
        <div class="radial-progress bg-{{ $color }}/10 border-4 border-transparent" style="--value:{{ $progress }}; --size:3rem; --thickness: 4px;" role="progressbar">
            <span class="text-[10px] font-bold">{{ $progress }}%</span>
        </div>
    </div>
    <div class="stat-title text-xs font-black uppercase opacity-50">{{ $label }}</div>
    <div class="stat-value text-2xl tracking-tighter">{{ $value }}</div>
    <div class="stat-desc font-medium mt-1">Goal: 100% completion</div>
</div>
