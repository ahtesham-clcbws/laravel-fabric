<div class="space-y-8 p-6 bg-base-200 min-h-screen">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-black uppercase tracking-tighter text-primary">Fabric Lab</h1>
            <p class="text-base-content/60 italic">Interactive design system previewer</p>
        </div>
        
        <div class="flex gap-4">
            <select wire:model.live="selectedModel" class="select select-bordered w-64">
                <option value="">Select Model...</option>
                @foreach($models as $model)
                    <option value="{{ $model }}">{{ class_basename($model) }}</option>
                @endforeach
            </select>

            <div class="join">
                <button wire:click="$set('viewport', 'desktop')" class="btn btn-sm join-item @if($viewport === 'desktop') btn-primary @endif">Desktop</button>
                <button wire:click="$set('viewport', 'tablet')" class="btn btn-sm join-item @if($viewport === 'tablet') btn-primary @endif">Tablet</button>
                <button wire:click="$set('viewport', 'mobile')" class="btn btn-sm join-item @if($viewport === 'mobile') btn-primary @endif">Mobile</button>
            </div>

            <select wire:model.live="selectedTheme" class="select select-bordered select-sm w-48">
                <option value="daisyui">DaisyUI 5</option>
                <option value="tailwind">Tailwind Pro</option>
            </select>
        </div>
    </div>

    @if($preview)
        <div @class([
            'mx-auto transition-all duration-300',
            'w-full' => $viewport === 'desktop',
            'max-w-2xl' => $viewport === 'tablet',
            'max-w-sm' => $viewport === 'mobile',
        ])>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Form Preview -->
            <div class="card bg-base-100 shadow-xl overflow-hidden">
                <div class="card-body">
                    <h2 class="card-title mb-4 border-b pb-2">Form Preview: {{ $preview['name'] }}</h2>
                    <div class="space-y-4">
                        {!! $preview['form'] !!}
                    </div>
                    <div class="card-actions justify-end mt-8 pt-4 border-t">
                        <button class="btn btn-ghost btn-sm">Reset</button>
                        <button class="btn btn-primary btn-sm px-8">Save Record</button>
                    </div>
                </div>
            </div>

            <!-- Table Preview -->
            <div class="card bg-base-100 shadow-xl overflow-hidden">
                <div class="card-body p-0">
                    <div class="p-8 pb-4">
                        <h2 class="card-title mb-2">Table Preview: {{ $preview['name'] }}</h2>
                        <div class="flex items-center gap-2">
                            <input type="text" class="input input-bordered input-sm flex-1" placeholder="Search..." />
                            <button class="btn btn-primary btn-sm">Add New</button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="table table-zebra w-full">
                            <thead>
                                <tr>
                                    <th class="w-12"><input type="checkbox" class="checkbox checkbox-sm" /></th>
                                    {!! $preview['table'] !!}
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="checkbox" class="checkbox checkbox-sm" /></td>
                                    @foreach($preview['fields'] as $name => $field)
                                        <td class="text-xs opacity-50 italic">Sample {{ $name }}</td>
                                    @endforeach
                                    <td><button class="btn btn-ghost btn-xs">Edit</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- SQL Trace Inspector -->
        <div class="collapse collapse-arrow bg-base-100 shadow-xl mt-4">
            <input type="checkbox" /> 
            <div class="collapse-title text-xl font-medium flex items-center gap-2">
                <span>SQL Trace Profiler</span>
                <span class="badge badge-primary">{{ count($queries) }} Queries</span>
            </div>
            <div class="collapse-content"> 
                <div class="space-y-2">
                    @foreach($queries as $query)
                        <div class="p-3 bg-base-300 rounded text-xs font-mono">
                            <p class="text-primary mb-1">{{ $query['sql'] }}</p>
                            <p class="opacity-50 italic">{{ $query['time'] }}ms</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Raw Data Inspector -->
        <div class="collapse collapse-arrow bg-base-100 shadow-xl mt-8">
            <input type="checkbox" /> 
            <div class="collapse-title text-xl font-medium">Loom Introspection Metadata</div>
            <div class="collapse-content"> 
                <pre class="bg-base-300 p-4 rounded-lg text-xs overflow-x-auto">@json($preview['fields'], JSON_PRETTY_PRINT)</pre>
            </div>
        </div>
        </div>
    @else
        <div class="hero bg-base-100 rounded-2xl py-24">
            <div class="hero-content text-center">
                <div class="max-w-md">
                    <div class="text-6xl mb-6">🔬</div>
                    <h1 class="text-2xl font-bold">Ready to Experiment?</h1>
                    <p class="py-6 opacity-60">Select a model from the top-right menu to see how Fabric will forge your components across different design systems.</p>
                </div>
            </div>
        </div>
    @endif
</div>
