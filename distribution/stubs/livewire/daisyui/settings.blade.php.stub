<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-base-content">System Settings</h1>
            <p class="text-base-content/60 mt-1">Manage your application configuration and global variables.</p>
        </div>
        <button wire:click="save" class="btn btn-primary gap-2 shadow-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg>
            Save Changes
        </button>
    </div>

    <div class="card bg-base-100 shadow-xl border border-base-200">
        <div class="card-body gap-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($state as $key => $value)
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text font-bold capitalize">{{ str_replace('_', ' ', $col ?? $key) }}</span>
                        </label>
                        @if(is_bool($value))
                            <input type="checkbox" wire:model="state.{{ $key }}" class="toggle toggle-primary" />
                        @elseif(strlen($value) > 100)
                            <textarea wire:model="state.{{ $key }}" class="textarea textarea-bordered h-24" placeholder="Enter {{ $key }}..."></textarea>
                        @else
                            <input type="text" wire:model="state.{{ $key }}" class="input input-bordered w-full" placeholder="Enter {{ $key }}..." />
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        <div class="card-actions justify-end p-6 bg-base-200/50 rounded-b-xl border-t border-base-200">
            <button wire:click="save" class="btn btn-primary btn-wide shadow-lg">Save Changes</button>
        </div>
    </div>
</div>
