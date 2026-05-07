<div class="p-6">
    <h2 class="text-lg font-medium text-gray-900 mb-4">
        {{ $record->exists ? __('Edit') : __('Create') }} Category
    </h2>

    <form wire:submit.prevent="save" class="space-y-4">
    <x-fabric::input label="Name" wire:model.blur="form.name" />
    <x-fabric::textarea label="Description" wire:model.blur="form.description" />


        <div class="flex justify-end space-x-3 mt-6">
            <button type="button" wire:click="$dispatch('closeModal')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50">
                {{ __('Cancel') }}
            </button>
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-600">
                {{ __('Save') }} Category
            </button>
        </div>
    </form>
</div>
