<div class="p-6 bg-base-200 min-h-screen space-y-8">
    <div>
        <h1 class="text-3xl font-black uppercase tracking-tighter text-base-content">{{ __('Dashboard') }}</h1>
        <p class="text-base-content/60">Welcome back to the Fabric Command Center.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($stats as $stat)
            <div class="card bg-base-100 shadow-xl border border-base-300">
                <div class="card-body p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-bold uppercase opacity-50">{{ $stat['label'] }}</p>
                            <h3 class="text-2xl font-black mt-1">{{ $stat['value'] }}</h3>
                        </div>
                        <div class="text-2xl">{{ $stat['icon'] }}</div>
                    </div>
                    <div class="mt-4 flex items-center gap-1 text-xs">
                        <span class="text-success font-bold">↑ {{ $stat['increase'] }}</span>
                        <span class="opacity-50">vs last month</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Panel -->
        <div class="lg:col-span-2 space-y-8">
            <div class="card bg-primary text-primary-content shadow-2xl overflow-hidden relative">
                <div class="absolute top-0 right-0 p-8 opacity-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-48 w-48" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                </div>
                <div class="card-body relative z-10">
                    <h2 class="card-title text-3xl font-black uppercase">Titan Edition v1.0.0</h2>
                    <p class="max-w-md opacity-90 py-4">Fabric has successfully forged your design system. You are now running on a zero-runtime, high-fidelity engine optimized for enterprise performance.</p>
                    <div class="card-actions justify-start">
                        <a href="{{ route('fabric.lab') }}" class="btn btn-secondary border-none">Enter the Lab</a>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="card bg-base-100 shadow-xl border border-base-300">
                <div class="card-body">
                    <h2 class="card-title uppercase text-sm font-bold opacity-50 mb-4">System Activity Log</h2>
                    <div class="space-y-4">
                        @forelse($activities as $activity)
                            <div class="flex items-center gap-4 p-3 hover:bg-base-200 rounded-xl transition">
                                <div class="w-10 h-10 bg-base-300 rounded-full flex items-center justify-center font-bold">A</div>
                                <div class="flex-1">
                                    <div class="text-sm font-bold">{{ $activity->description }}</div>
                                    <div class="text-xs opacity-50">{{ $activity->created_at->diffForHumans() }}</div>
                                </div>
                            </div>
                        @empty
                            <div class="py-12 text-center opacity-40 italic text-sm">
                                No recent activity found. Forged resources will appear here.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Panel -->
        <div class="space-y-6">
             <div class="card bg-base-100 shadow-xl border border-base-300">
                <div class="card-body">
                    <h2 class="card-title text-sm uppercase font-bold opacity-50">Quick Actions</h2>
                    <ul class="menu menu-vertical p-0 gap-2">
                        <li><a href="{{ route('fabric.lab') }}" class="btn btn-ghost justify-start gap-3">🔬 Component Lab</a></li>
                        <li><button wire:click="toggleMaintenance" class="btn {{ $maintenanceMode ? 'btn-error' : 'btn-ghost' }} justify-start gap-3">
                            🛡️ {{ $maintenanceMode ? 'Disable' : 'Enable' }} Maintenance
                        </button></li>
                    </ul>
                </div>
            </div>

            <div class="card bg-base-100 shadow-xl border border-base-300">
                <div class="card-body">
                    <h2 class="card-title text-sm uppercase font-bold opacity-50">System Health</h2>
                    <div class="space-y-4 mt-2">
                        <div class="flex justify-between text-xs">
                            <span>CPU Usage</span>
                            <span class="font-bold">12%</span>
                        </div>
                        <progress class="progress progress-primary w-full" value="12" max="100"></progress>
                        
                        <div class="flex justify-between text-xs">
                            <span>Memory</span>
                            <span class="font-bold">64MB / 512MB</span>
                        </div>
                        <progress class="progress progress-secondary w-full" value="25" max="100"></progress>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
