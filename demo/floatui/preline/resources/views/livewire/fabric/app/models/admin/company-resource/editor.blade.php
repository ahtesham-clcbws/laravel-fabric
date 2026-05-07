<div class="p-6">
    <h2 class="text-lg font-medium text-gray-900 mb-4">
        {{ $record->exists ? __('Edit') : __('Create') }} CompanyResource
    </h2>

    <form wire:submit.prevent="save" class="space-y-4">
    <x-fabric::input label="Name" wire:model.blur="form.name" />
    <x-fabric::textarea label="Description" wire:model.blur="form.description" />
    <x-fabric::input label="Email" wire:model.blur="form.email" />
    <x-fabric::input label="Active" wire:model.blur="form.active" />
    <x-fabric::input label="Founded At" wire:model.blur="form.founded_at" />
    <x-fabric::input label="Last Audit At" wire:model.blur="form.last_audit_at" />
    <x-fabric::textarea label="Settings" wire:model.blur="form.settings" />

    <div class="space-y-2">
        <label class="text-sm font-medium text-gray-700">Type</label>
        <div class="flex flex-wrap gap-4">
            @foreach(App\Enums\CompanyType::cases() as $case)
                <label class="inline-flex items-center">
                    <input type="radio" 
                           wire:model.blur="form.type" 
                           value="{{ $case instanceof \BackedEnum ? $case->value : $case->name }}" 
                           class="text-indigo-600 focus:ring-indigo-600">
                    <span class="ml-2 text-sm text-gray-600">
                        {{ method_exists($case, 'getLabel') ? $case->getLabel() : \Illuminate\Support\Str::headline($case->name) }}
                    </span>
                </label>
            @endforeach
        </div>
    </div>
    <x-fabric::input type="number" label="Category Id" wire:model.blur="form.category_id" step="1" />


        <div class="flex justify-end space-x-3 mt-6">
            <button type="button" wire:click="$dispatch('closeModal')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50">
                {{ __('Cancel') }}
            </button>
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-600">
                {{ __('Save') }} CompanyResource
            </button>
        </div>
    </form>
</div>
