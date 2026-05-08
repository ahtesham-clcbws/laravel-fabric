<div class="p-6 bg-base-100 rounded-box">
    
    <h3 class="text-xl font-bold mb-6 text-base-content">
        {{ $record->exists ? 'Update' : 'Create New' }} Post
    </h3>

    <form wire:submit.prevent="save" class="space-y-6">

    <div class="flex items-end gap-2">
        <div class="flex-1">
            <x-fabric::select label="Category Id" wire:model.blur="form.category_id">
                <option value="">Select App\Models\Category</option>
                @foreach($categories as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </x-fabric::select>
        </div>
        <button type="button" 
                wire:click="$dispatch('openModal', { component: 'livewire.fabric.category.editor' })"
                class="p-2 mb-1 bg-gray-50 border border-gray-200 rounded-md hover:bg-gray-100 transition">
            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
        </button>
    </div>
    <x-fabric::input label="Title" wire:model.blur="form.title" />
    <x-fabric::textarea label="Content" wire:model.blur="form.content" />
    <x-fabric::input label="Is Published" wire:model.blur="form.is_published" />
    <x-fabric::input label="Published At" wire:model.blur="form.published_at" />
    <x-fabric::textarea label="Meta Data" wire:model.blur="form.meta_data" />

        <!-- [FABRIC-HEAL-FORM] -->

        <div class="modal-action">
            <button type="button" wire:click="$dispatch('closeModal')" class="btn btn-ghost">Cancel</button>
            <button type="submit" class="btn btn-primary">
                <span wire:loading wire:target="save" class="loading loading-spinner loading-xs"></span>
                Save Post
            </button>
        </div>
    </form>
    
    
</div>
