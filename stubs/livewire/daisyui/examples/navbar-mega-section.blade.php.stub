<div class="navbar bg-base-100 shadow-lg px-4 lg:px-8">
    <div class="navbar-start">
        <a class="btn btn-ghost text-xl font-black italic tracking-tighter">{{ config('app.name') }}</a>
    </div>
    
    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal px-1">
            <li><a>{{ __('Home') }}</a></li>
            <li class="group">
                <details>
                    <summary>{{ __('Solutions') }}</summary>
                    <div class="p-6 bg-base-100 shadow-2xl rounded-2xl w-[600px] grid grid-cols-2 gap-4">
                        <a href="#" class="flex gap-4 p-4 hover:bg-base-200 rounded-xl transition">
                            <div class="text-2xl">🚀</div>
                            <div>
                                <div class="font-bold text-sm">{{ __('Quick Deploy') }}</div>
                                <div class="text-xs opacity-60">{{ __('Spin up servers in minutes.') }}</div>
                            </div>
                        </a>
                        <a href="#" class="flex gap-4 p-4 hover:bg-base-200 rounded-xl transition">
                            <div class="text-2xl">🛡️</div>
                            <div>
                                <div class="font-bold text-sm">{{ __('Advanced Security') }}</div>
                                <div class="text-xs opacity-60">{{ __('Enterprise grade encryption.') }}</div>
                            </div>
                        </a>
                        <a href="#" class="flex gap-4 p-4 hover:bg-base-200 rounded-xl transition">
                            <div class="text-2xl">📈</div>
                            <div>
                                <div class="font-bold text-sm">{{ __('Analytics') }}</div>
                                <div class="text-xs opacity-60">{{ __('Real-time performance metrics.') }}</div>
                            </div>
                        </a>
                        <a href="#" class="flex gap-4 p-4 hover:bg-base-200 rounded-xl transition">
                            <div class="text-2xl">☁️</div>
                            <div>
                                <div class="font-bold text-sm">{{ __('Cloud Sync') }}</div>
                                <div class="text-xs opacity-60">{{ __('Scale globally with zero lag.') }}</div>
                            </div>
                        </a>
                    </div>
                </details>
            </li>
            <li><a>{{ __('Pricing') }}</a></li>
        </ul>
    </div>

    <div class="navbar-end gap-4">
        <livewire:fabric.omnisearch />
        @auth
            <a href="{{ route('dashboard') }}" class="btn btn-primary">{{ __('Dashboard') }}</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-ghost">{{ __('Login') }}</a>
            <a href="{{ route('register') }}" class="btn btn-primary">{{ __('Sign Up') }}</a>
        @endauth
    </div>
</div>
