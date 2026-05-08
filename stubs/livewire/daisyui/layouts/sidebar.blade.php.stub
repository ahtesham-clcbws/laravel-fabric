<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ theme: localStorage.getItem('fabric-theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light') }" :data-theme="theme">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name', 'Laravel') }} - Fabric</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased text-base-content bg-base-200">
    <div class="drawer lg:drawer-open min-h-screen">
        <input id="fabric-sidebar" type="checkbox" class="drawer-toggle" />
        
        <div class="drawer-content flex flex-col min-h-screen">
            <!-- Mobile Navbar -->
            <header class="navbar bg-base-100 border-b border-base-300 lg:hidden px-4 sticky top-0 z-30">
                <div class="flex-none">
                    <label for="fabric-sidebar" class="btn btn-square btn-ghost drawer-button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </label>
                </div>
                <div class="flex-1 font-black text-xl italic tracking-tighter uppercase">{{ config('app.name') }}</div>
            </header>

            <!-- Main Content Area -->
            <main class="p-4 sm:p-8 flex-1 overflow-y-auto">
                <div class="max-w-[1600px] mx-auto">
                    {{ $slot }}
                </div>
            </main>
        </div>

        <!-- Sidebar -->
        <div class="drawer-side z-40 border-r border-base-300">
            <label for="fabric-sidebar" aria-label="close sidebar" class="drawer-overlay"></label>
            
            <div class="flex flex-col h-full w-80 bg-base-100">
                <!-- Sidebar Header -->
                <div class="p-6 border-b border-base-300">
                    <a href="{{ route('fabric.dashboard') }}" class="flex items-center gap-4 group">
                        <div class="w-12 h-12 bg-primary text-primary-content flex items-center justify-center rounded-2xl font-black text-2xl shadow-lg transition group-hover:rotate-12 shadow-primary/20">F</div>
                        <div>
                            <h1 class="text-xl font-black tracking-tight leading-none uppercase">{{ config('app.name') }}</h1>
                            <p class="text-[10px] opacity-40 uppercase tracking-[0.2em] font-bold mt-1">v1.0.0 Stable</p>
                        </div>
                    </a>
                </div>

                <!-- Sidebar Navigation -->
                <div class="flex-1 flex flex-col overflow-y-auto py-6">
                    <!-- Search Trigger -->
                    <div class="px-6 mb-8">
                        @livewire('fabric.omnisearch')
                    </div>

                    <ul class="menu p-0 w-full flex-1">
                        <li class="menu-title opacity-40 uppercase text-xs font-bold px-6 mb-4">{{ __('General') }}</li>
                        <li>
                            <a href="{{ route('fabric.dashboard') }}" 
                               @class([
                                   '!bg-primary !text-primary-content !font-bold !rounded-none px-6 py-4 w-full' => request()->routeIs('fabric.dashboard'),
                                   '!rounded-none px-6 py-4 w-full hover:bg-base-200 transition' => !request()->routeIs('fabric.dashboard')
                               ])
                               wire:navigate>
                                <span class="text-xl">🏠</span>
                                {{ __('Dashboard') }}
                            </a>
                        </li>

                        @php
                            try {
                                $registry = app(\CLCBWS\Fabric\Services\SearchRegistry::class);
                                $groupedResources = collect($registry->getResources())->groupBy('group');
                            } catch (\Exception $e) {
                                $groupedResources = collect();
                            }
                        @endphp

                        @foreach($groupedResources as $group => $resources)
                            <li class="menu-title opacity-40 uppercase text-xs font-bold mt-8 px-6 mb-4">{{ __($group) }}</li>
                            @foreach($resources as $res)
                                <li>
                                    <a href="{{ route($res['route']) }}" 
                                       @class([
                                           '!bg-primary !text-primary-content !font-bold !rounded-none px-6 py-4 w-full' => request()->routeIs($res['route']),
                                           '!rounded-none px-6 py-4 w-full hover:bg-base-200 transition' => !request()->routeIs($res['route'])
                                       ])
                                       wire:navigate>
                                        <span class="text-xl">{{ $res['icon'] }}</span>
                                        {{ \Illuminate\Support\Str::plural(\Illuminate\Support\Str::headline($res['name'] ?? 'Resource')) }}
                                    </a>
                                </li>
                            @endforeach
                        @endforeach
                    </ul>
                </div>

                <!-- Sidebar Footer -->
                @auth
                <div class="mt-auto border-t border-base-300 bg-base-200/50 p-4">
                    <div class="dropdown dropdown-top w-full">
                        <div tabindex="0" role="button" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-base-300 transition cursor-pointer group w-full">
                            <div class="avatar online">
                                <div class="w-10 rounded-full border-2 border-primary">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&color=7F9CF5&background=EBF4FF" />
                                </div>
                            </div>
                            <div class="flex-1 overflow-hidden text-left">
                                <div class="font-bold truncate text-sm">{{ auth()->user()->name }}</div>
                                <div class="text-[10px] opacity-50 truncate uppercase tracking-wider">{{ auth()->user()->email }}</div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-20 group-hover:opacity-100 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" /></svg>
                        </div>
                        
                        <ul tabindex="0" class="dropdown-content z-50 menu p-2 shadow-2xl bg-base-100 border border-base-300 rounded-box w-72 mb-2">
                            <li class="menu-title text-xs opacity-50 uppercase tracking-widest">{{ __('Settings') }}</li>
                            <li>
                                <button @click="theme = (theme === 'dark' ? 'light' : 'dark'); localStorage.setItem('fabric-theme', theme)">
                                    <svg x-show="theme === 'light'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                                    <svg x-show="theme === 'dark'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-warning" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 9H3m3.343-5.657l.707.707m12.728 12.728l.707.707M6.343 17.657l-.707.707M17.657 6.343l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                    <span>{{ __('Toggle Theme') }}</span>
                                </button>
                            </li>
                            <div class="divider my-0 opacity-20"></div>
                            <li><a href="{{ route('fabric.profile') }}" wire:navigate>{{ __('My Profile') }}</a></li>
                            <li>
                                <form method="POST" action="{{ route('fabric.logout') }}" class="w-full p-0">
                                    @csrf
                                    <button type="submit" class="w-full text-left text-error">{{ __('Logout') }}</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </div>
    @livewireScripts
</body>
</html>
