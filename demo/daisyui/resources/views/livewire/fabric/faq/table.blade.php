<div class="card bg-base-100 shadow-xl border border-base-200">
    <div class="card-body">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
            <div class="form-control w-full max-w-xs">
                <div class="join">
                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search faqs..." class="input input-bordered join-item w-full" />
                    <button class="btn btn-square join-item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </button>
                </div>
            </div>

            <div class="flex items-center gap-4">
                @if(count($selected) > 0)
                    <div class="flex items-center gap-2 animate-in fade-in slide-in-from-right-4 duration-300">
                        <span class="text-sm font-bold text-base-content/60">{{ count($selected) }} selected</span>
                        <button wire:click="deleteSelected" 
                                wire:confirm="Are you sure you want to delete {{ count($selected) }} items?"
                                class="btn btn-error btn-sm btn-outline gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            Delete
                        </button>
                    </div>
                @endif

                <div class="flex gap-2">
                    
            
            <button wire:click="$dispatch('openModal', { component: 'fabric.faq.editor' })" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 transition btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" /></svg>
                Add Faq
            </button>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto rounded-box">
            <table class="table table-zebra w-full">
                <thead>
                    <tr>
                        <th class="w-10">
                            <input type="checkbox" wire:model.live="selectAll" class="checkbox checkbox-primary checkbox-sm" />
                        </th>
                @if($columnVisibility['question'] ?? true)
                <th class="">Question</th>
                @endif
                @if($columnVisibility['answer'] ?? true)
                <th class="">Answer</th>
                @endif
                @if($columnVisibility['is_published'] ?? true)
                <th class="">Is Published</th>
                @endif

                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody wire:loading.class="opacity-50">
                    @forelse($rows as $row)
                        <tr class="hover group">
                            <td>
                                <input type="checkbox" value="{{ $row->id }}" wire:model.live="selected" class="checkbox checkbox-primary checkbox-sm" />
                            </td>
                        @if($columnVisibility['question'] ?? true)
                        <td class="">{{ $row->question }}</td>
                        @endif
                        @if($columnVisibility['answer'] ?? true)
                        <td class="">{{ $row->answer }}</td>
                        @endif
                        @if($columnVisibility['is_published'] ?? true)
                        <td class="">{{ $row->is_published }}</td>
                        @endif

                            <td class="text-right">
                                 <button wire:click="$dispatch('openModal', { component: 'fabric.faq.editor', arguments: { record: {{ $row->id }} } })" class="text-indigo-600 hover:text-indigo-900">Edit</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%" class="text-center py-10 text-base-content/50 italic">No faqs found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $rows->links() }}
        </div>
    </div>
</div>
