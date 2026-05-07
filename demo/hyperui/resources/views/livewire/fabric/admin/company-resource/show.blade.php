<div class="overflow-hidden bg-white shadow sm:rounded-lg">
    <div class="px-4 py-6 sm:px-6 flex justify-between items-center">
        <div>
            <h3 class="text-base font-semibold leading-7 text-gray-900">CompanyResource {{ __('Details') }}</h3>
            <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">{{ __('Full information and metadata for this record.') }}</p>
        </div>
        <div class="flex gap-3">
            <button wire:click="$dispatch('openModal', { component: 'livewire.fabric.admin.company-resource.editor', arguments: { record: {{ $record->id }} } })" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-600">
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
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-900">{{ __('Email') }}</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{ $record->email ?: '—' }}
                </dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-900">{{ __('Active') }}</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{ $record->active ?: '—' }}
                </dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-900">{{ __('Founded At') }}</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    <span class="font-mono text-gray-500">{{ $record->founded_at?->format('Y-m-d') ?? '—' }}</span>
                </dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-900">{{ __('Last Audit At') }}</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    <span class="font-mono text-gray-500">{{ $record->last_audit_at?->format('Y-m-d H:i') ?? '—' }}</span>
                </dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-900">{{ __('Settings') }}</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{ $record->settings ?: '—' }}
                </dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-900">{{ __('Type') }}</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{ $record->type ?: '—' }}
                </dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-900">{{ __('Category Id') }}</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{ $record->category_id ?: '—' }}
                </dd>
            </div>

            
            <!-- [FABRIC-HOOK:ADDITIONAL-DETAILS] -->
            
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 border-t">
                    <dt class="text-sm font-medium text-gray-900">Activity History</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <ul role="list" class="space-y-6">
                            @foreach($record->activities()->latest()->take(10)->get() as $activity)
                                <li class="relative flex gap-x-4">
                                    <div class="absolute left-0 top-0 flex w-6 justify-center -bottom-6">
                                        <div class="w-px bg-gray-200"></div>
                                    </div>
                                    <div class="relative flex h-6 w-6 flex-none items-center justify-center bg-white">
                                        <div class="h-1.5 w-1.5 rounded-full bg-gray-100 ring-1 ring-gray-300"></div>
                                    </div>
                                    <p class="flex-auto py-0.5 text-xs leading-5 text-gray-500">
                                        <span class="font-medium text-gray-900">{{ $activity->causer?->name ?? 'System' }}</span> 
                                        {{ $activity->description }} 
                                        <span class="whitespace-nowrap">{{ $activity->created_at->diffForHumans() }}</span>
                                    </p>
                                </li>
                            @endforeach
                        </ul>
                    </dd>
                </div>
        </dl>
    </div>

    <!-- Related Resources -->
    
    <div class="mt-8 border-t border-gray-100 pt-8">
        <h4 class="text-md font-bold text-gray-900 mb-4">App\Models\Main.companyResourceTags</h4>
        <livewire:fabric.main.company_resource_tag.table :filters="['company_resource_id' => $record->id]" />
    </div>

</div>
