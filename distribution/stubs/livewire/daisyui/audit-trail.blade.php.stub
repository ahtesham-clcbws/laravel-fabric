<div class="space-y-4">
    <h3 class="text-lg font-bold text-base-content/80 uppercase tracking-widest">{{ __('Activity Timeline') }}</h3>
    
    <div class="overflow-x-auto">
        <table class="table table-zebra w-full border rounded-xl overflow-hidden shadow-sm">
            <thead class="bg-base-200">
                <tr>
                    <th>Event</th>
                    <th>User</th>
                    <th>Origin</th>
                    <th>Changes</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($activities as $activity)
                    <tr class="hover">
                        <td>
                            <span @class([
                                'badge font-bold uppercase text-[10px]',
                                'badge-success' => $activity->event === 'created',
                                'badge-info' => $activity->event === 'updated',
                                'badge-warning' => $activity->event === 'restored',
                                'badge-error' => $activity->event === 'deleted',
                            ])>{{ $activity->event }}</span>
                        </td>
                        <td>
                            <div class="flex items-center gap-2">
                                <div class="avatar placeholder">
                                    <div class="bg-neutral text-neutral-content rounded-full w-6 h-6">
                                        <span class="text-[10px]">{{ substr($activity->user?->name ?? '?', 0, 1) }}</span>
                                    </div>
                                </div>
                                <span class="text-xs font-medium">{{ $activity->user?->name ?? 'System' }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="flex flex-col gap-0.5">
                                <span class="text-[10px] font-mono opacity-60">{{ $activity->ip_address }}</span>
                                <span class="text-[9px] opacity-40 truncate max-w-[120px]" title="{{ $activity->user_agent }}">
                                    {{ Str::limit($activity->user_agent, 20) }}
                                </span>
                            </div>
                        </td>
                        <td class="text-xs max-w-md">
                            @if($activity->event === 'updated')
                                <div class="space-y-1">
                                    @foreach($activity->new_values as $key => $new)
                                        <div class="grid grid-cols-3 gap-2">
                                            <span class="font-bold opacity-50">{{ Str::headline($key) }}:</span>
                                            <span class="line-through text-error opacity-70">{{ $activity->old_values[$key] ?? '—' }}</span>
                                            <span class="text-success font-bold">{{ $new }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <span class="opacity-50 italic">Full record {{ $activity->event }}</span>
                            @endif
                        </td>
                        <td class="text-[11px] font-mono opacity-50">
                            {{ $activity->created_at->format('M d, Y H:i') }}
                        </td>
                        <td>
                            @if($activity->event === 'updated')
                                <button wire:click="rollbackTo({{ $activity->id }})" class="btn btn-xs btn-outline">Rollback</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
