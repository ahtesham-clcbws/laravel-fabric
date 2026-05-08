<div class="card bg-base-100 shadow-xl border border-base-200">
    <div class="card-body">
        <div class="flex justify-between items-center mb-8">
            <div>
                <div class="flex items-center justify-between gap-4 mb-6">
            <h3 class="text-xl font-bold text-base-content">Tag Details</h3>
            <livewire:fabric.social-share :record="$record" />
        </div>
                <h2 class="card-title text-2xl font-black uppercase tracking-tighter text-primary">Tag Detail</h2>
                <p class="text-sm opacity-50">Comprehensive record overview</p>
            </div>
            <div class="flex gap-2">
                <button wire:click="$dispatch('openModal', { component: 'livewire.fabric.tag.editor', arguments: { record: {{ $record->id }} } })" class="btn btn-primary btn-sm">Edit</button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($record->getAttributes() as $key => $value)
                <div class="form-control">
                    <label class="label opacity-50 uppercase text-xs font-bold">{{ str($key)->headline() }}</label>
                    <div class="px-4 py-3 bg-base-200 rounded-lg font-medium">{{ $value ?: '—' }}</div>
                </div>
            @endforeach
            
            <!-- [FABRIC-HOOK:ADDITIONAL-DETAILS] -->
        </div>
    </div>
</div>
