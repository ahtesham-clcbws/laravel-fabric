<div class="p-6 bg-base-100 rounded-box">
    
    <h3 class="text-xl font-bold mb-6 text-base-content">
        {{ $record->exists ? 'Update' : 'Create New' }} Testimonial
    </h3>

    <form wire:submit.prevent="save" class="space-y-6">

        <!-- [FABRIC-HEAL-FORM] -->

        <div class="modal-action">
            <button type="button" wire:click="$dispatch('closeModal')" class="btn btn-ghost">Cancel</button>
            <button type="submit" class="btn btn-primary">
                <span wire:loading wire:target="save" class="loading loading-spinner loading-xs"></span>
                Save Testimonial
            </button>
        </div>
    </form>
    
    
</div>
