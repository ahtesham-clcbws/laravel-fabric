<div class="p-6">
    <h2 class="text-lg font-medium text-gray-900 mb-4">
        {{ $record->exists ? __('Edit') : __('Create') }} Post
    </h2>

    <form wire:submit.prevent="save" class="space-y-4">
    <x-fabric::input type="number" label="Category Id" wire:model.blur="form.category_id" step="1" />
    <x-fabric::input label="Title" wire:model.blur="form.title" />
    <x-fabric::textarea label="Content" wire:model.blur="form.content" />
    <x-fabric::input label="Is Published" wire:model.blur="form.is_published" />
    <x-fabric::input label="Published At" wire:model.blur="form.published_at" />
    <x-fabric::textarea label="Meta Data" wire:model.blur="form.meta_data" />


        <div class="flex justify-end space-x-3 mt-6">
            <button type="button" wire:click="$dispatch('closeModal')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50">
                {{ __('Cancel') }}
            </button>
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-600">
                {{ __('Save') }} Post
            </button>
        </div>
    </form>
</div>
