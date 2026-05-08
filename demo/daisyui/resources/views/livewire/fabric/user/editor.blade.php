<div class="p-6 bg-base-100 rounded-box">
    
    <h3 class="text-xl font-bold mb-6 text-base-content">
        {{ $record->exists ? 'Update' : 'Create New' }} User
    </h3>

    <form wire:submit.prevent="save" class="space-y-6">
    <x-fabric::input label="Name" wire:model.blur="form.name" />
    <x-fabric::input label="Email" wire:model.blur="form.email" />

        <!-- [FABRIC-HEAL-FORM] -->

        <div class="modal-action">
            <button type="button" wire:click="$dispatch('closeModal')" class="btn btn-ghost">Cancel</button>
            <button type="submit" class="btn btn-primary">
                <span wire:loading wire:target="save" class="loading loading-spinner loading-xs"></span>
                Save User
            </button>
        </div>
    </form>
    
    
</div>
