<div class="overflow-hidden bg-white shadow sm:rounded-lg">
    <div class="px-4 py-6 sm:px-6 flex justify-between items-center">
        <div>
            <h3 class="text-base font-semibold leading-7 text-gray-900">Category {{ __('Details') }}</h3>
            <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">{{ __('Full information and metadata for this record.') }}</p>
        </div>
        <div class="flex gap-3">
            <button wire:click="$dispatch('openModal', { component: 'livewire.fabric.app.models.category.editor', arguments: { record: {{ $record->id }} } })" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-600">
                {{ __('Edit') }}
            </button>
        </div>
    </div>
    <div class="border-t border-gray-100">
        <dl class="divide-y divide-gray-100">
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-900">{{ __('Name') }}</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{ $record->name ?: '—' }}
                </dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-900">{{ __('Description') }}</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{ $record->description ?: '—' }}
                </dd>
            </div>

            
            <!-- [FABRIC-HOOK:ADDITIONAL-DETAILS] -->
            
        </dl>
    </div>

    <!-- Related Resources -->
    
    <div class="mt-8 border-t border-gray-100 pt-8">
        <h4 class="text-md font-bold text-gray-900 mb-4">App\Models\Main.posts</h4>
        <livewire:fabric.main.post.table :filters="['category_id' => $record->id]" />
    </div>

</div>
