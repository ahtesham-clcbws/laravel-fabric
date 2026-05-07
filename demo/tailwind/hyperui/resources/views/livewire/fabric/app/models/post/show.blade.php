<div class="overflow-hidden bg-white shadow sm:rounded-lg">
    <div class="px-4 py-6 sm:px-6 flex justify-between items-center">
        <div>
            <h3 class="text-base font-semibold leading-7 text-gray-900">Post {{ __('Details') }}</h3>
            <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">{{ __('Full information and metadata for this record.') }}</p>
        </div>
        <div class="flex gap-3">
            <button wire:click="$dispatch('openModal', { component: 'livewire.fabric.app.models.post.editor', arguments: { record: {{ $record->id }} } })" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-600">
                {{ __('Edit') }}
            </button>
        </div>
    </div>
    <div class="border-t border-gray-100">
        <dl class="divide-y divide-gray-100">
                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-900">{{ __('Category Id') }}</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{ $record->category_id ?: '—' }}
                </dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-900">{{ __('Title') }}</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{ $record->title ?: '—' }}
                </dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-900">{{ __('Content') }}</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{ $record->content ?: '—' }}
                </dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-900">{{ __('Is Published') }}</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{ $record->is_published ?: '—' }}
                </dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-900">{{ __('Published At') }}</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    <span class="font-mono text-gray-500">{{ $record->published_at?->format('Y-m-d H:i') ?? '—' }}</span>
                </dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-900">{{ __('Meta Data') }}</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{ $record->meta_data ?: '—' }}
                </dd>
            </div>

            
            <!-- [FABRIC-HOOK:ADDITIONAL-DETAILS] -->
            
        </dl>
    </div>

    <!-- Related Resources -->
    
</div>
