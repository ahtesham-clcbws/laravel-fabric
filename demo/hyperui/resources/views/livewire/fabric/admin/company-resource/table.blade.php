<div class="p-6 bg-white border-b border-gray-200 shadow-sm rounded-lg" x-data="{ showColumnPicker: false }">
    <!-- Header Actions -->
    <div class="flex items-center justify-between mb-6 gap-4">
        <div class="flex-1 max-w-sm relative">
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="{{ __('Search') }} companyResources..." class="w-full border-gray-300 rounded-md shadow-sm pl-10 focus:border-indigo-600 focus:ring-indigo-600">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            </div>
        </div>

        <div class="flex items-center gap-3">
            
            <x-fabric::select wire:model.live="filters.trash" class="w-40">
                <option value="">Active Records</option>
                <option value="with">All Records</option>
                <option value="only">Trash Only</option>
            </x-fabric::select>
            
            <div class="flex items-center gap-2">
                <label class="text-xs font-bold text-gray-500 uppercase">Show Trashed</label>
                <input type="checkbox" wire:model.live="showTrashed" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-600">
            </div>
            <!-- Column Picker -->
            <div class="relative">
                <button @click="showColumnPicker = !showColumnPicker" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                    {{ __('Columns') }}
                </button>
            </div>

            
            @can('create-companyresource')
                
            <button wire:click="$dispatch('openModal', { component: 'fabric.admin.company-resource.company-resource-editor' })" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-600 focus:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 transition">
                Add CompanyResource
            </button>
            @endcan
        </div>
    </div>

    <!-- Bulk Action Toolbar -->
    @if(count($selected) > 0)
        <div class="bg-indigo-50 p-4 mb-4 rounded-md flex items-center justify-between animate-in fade-in slide-in-from-top-2">
            <span class="text-sm text-indigo-600">{{ count($selected) }} items selected</span>
            <div class="flex gap-2">
                <button class="text-xs font-bold text-red-600 uppercase hover:underline">Bulk Delete</button>
                <button class="text-xs font-bold text-indigo-600 uppercase hover:underline">Export</button>
            </div>
        </div>
    @endif

    <!-- Table Content -->
    <div class="relative overflow-x-auto">
        <div wire:loading.flex class="absolute inset-0 z-10 bg-white/50 backdrop-blur-sm items-center justify-center">
            <div class="flex items-center gap-2">
                <svg class="animate-spin h-5 w-5 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                <span class="text-sm font-medium text-gray-500">{{ __('Processing...') }}</span>
            </div>
        </div>
        <table class="min-w-full divide-y divide-gray-200" wire:loading.class="opacity-50">
            <thead class="bg-gray-50">
                <tr>
                    <th class="w-10 px-6 py-3">
                        <input type="checkbox" wire:model.live="selectAll" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-600">
                    </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Active</th>
                <th class="px-6 py-3 text-left">
                    <button wire:click="sortBy('founded_at')" class="group inline-flex items-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Founded At
                        <span class="ml-2 flex-none rounded text-gray-400 group-hover:bg-gray-200">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" /></svg>
                        </span>
                    </button>
                </th>
                <th class="px-6 py-3 text-left">
                    <button wire:click="sortBy('last_audit_at')" class="group inline-flex items-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Last Audit At
                        <span class="ml-2 flex-none rounded text-gray-400 group-hover:bg-gray-200">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" /></svg>
                        </span>
                    </button>
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Settings</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                <th class="px-6 py-3 text-left">
                    <button wire:click="sortBy('category_id')" class="group inline-flex items-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Category Id
                        <span class="ml-2 flex-none rounded text-gray-400 group-hover:bg-gray-200">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" /></svg>
                        </span>
                    </button>
                </th>

                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200" wire:loading.class="opacity-50">
                @forelse($rows as $row)
                    <tr wire:key="row-{{ $row->id }}" class="{{ in_array($row->id, $selected) ? 'bg-indigo-50' : '' }} hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <input type="checkbox" value="{{ $row->id }}" wire:model.live="selected" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-600">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $row->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $row->description }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $row->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $row->active }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-mono">
                            {{ $row->founded_at?->format('Y-m-d') ?? '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-mono">
                            {{ $row->last_audit_at?->format('Y-m-d H:i') ?? '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-mono">{{ is_array($row->settings) ? json_encode($row->settings) : $row->settings }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $row->type }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $row->category_id }}</td>

                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            
            @if($row->trashed())
                <button wire:click="restore({{ $row->id }})" class="text-green-600 hover:text-green-900">Restore</button>
            @endif
            @can('update-companyresource')
                <button wire:click="$dispatch('openModal', { component: 'fabric.admin.company-resource.company-resource-editor', arguments: { record: {{ $row->id }} } })" class="text-indigo-600 hover:text-indigo-900">Edit</button>
            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="100%" class="px-6 py-10 text-center text-gray-500 italic">No companyResources found matching your search.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $rows->links() }}
    </div>
</div>
