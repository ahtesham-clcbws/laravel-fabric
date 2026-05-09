<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @inject('settings', 'App\Settings\GeneralSettings')

    <title>{{ $settings->site_name }} - {{ $title ?? 'Welcome' }}</title>
    <meta name="description" content="{{ $settings->site_description }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .container-1300 {
            max-width: 1300px !important;
            margin-left: auto !important;
            margin-right: auto !important;
            width: 100% !important;
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }
        @media (min-width: 1024px) {
            .container-1300 {
                padding-left: 2.5rem;
                padding-right: 2.5rem;
            }
        }
    </style>
</head>
<body class="min-h-screen bg-base-100 antialiased selection:bg-primary selection:text-primary-content">
    <!-- Navbar -->
    <div class="navbar bg-base-100/80 backdrop-blur-xl sticky top-0 z-50 border-b border-base-200 py-6">
        <div class="container-1300 flex items-center justify-between">
            <div class="navbar-start">
                <div class="dropdown">
                    <label tabindex="0" class="btn btn-ghost lg:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" /></svg>
                    </label>
                    <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-1 p-4 shadow-2xl bg-base-100 rounded-3xl w-64 border border-base-200">
                        <li><a href="{{ route('home') }}" class="py-3 font-bold">Home</a></li>
                        <li><a href="{{ route('about') }}" class="py-3 font-bold">About</a></li>
                        <li><a href="{{ route('services.index') }}" class="py-3 font-bold">Services</a></li>
                        <li><a href="{{ route('portfolio') }}" class="py-3 font-bold">Portfolio</a></li>
                        <li><a href="{{ route('pricing') }}" class="py-3 font-bold">Pricing</a></li>
                        <li><a href="{{ route('team') }}" class="py-3 font-bold">Team</a></li>
                        <li><a href="{{ route('blog.index') }}" class="py-3 font-bold">Blog</a></li>
                        <li><a href="{{ route('faq') }}" class="py-3 font-bold">FAQ</a></li>
                        <li><a href="{{ route('contact') }}" class="py-3 font-bold">Contact</a></li>
                    </ul>
                </div>
                <a href="{{ route('home') }}" class="text-3xl font-black tracking-tighter">
                    <span class="text-primary">Laravel</span>Fabric
                </a>
            </div>
            <div class="navbar-center hidden lg:flex">
                <ul class="menu menu-horizontal px-1 font-bold gap-4 uppercase text-[10px] tracking-[0.2em]">
                    <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-primary' : 'opacity-50 hover:opacity-100' }}">Home</a></li>
                    <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'text-primary' : 'opacity-50 hover:opacity-100' }}">About</a></li>
                    <li><a href="{{ route('services.index') }}" class="{{ request()->routeIs('services.*') ? 'text-primary' : 'opacity-50 hover:opacity-100' }}">Services</a></li>
                    <li><a href="{{ route('portfolio') }}" class="{{ request()->routeIs('portfolio') ? 'text-primary' : 'opacity-50 hover:opacity-100' }}">Portfolio</a></li>
                    <li><a href="{{ route('pricing') }}" class="{{ request()->routeIs('pricing') ? 'text-primary' : 'opacity-50 hover:opacity-100' }}">Pricing</a></li>
                    <li><a href="{{ route('team') }}" class="{{ request()->routeIs('team') ? 'text-primary' : 'opacity-50 hover:opacity-100' }}">Team</a></li>
                    <li><a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'text-primary' : 'opacity-50 hover:opacity-100' }}">Blog</a></li>
                    <li><a href="{{ route('faq') }}" class="{{ request()->routeIs('faq') ? 'text-primary' : 'opacity-50 hover:opacity-100' }}">FAQ</a></li>
                    <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'text-primary' : 'opacity-50 hover:opacity-100' }}">Contact</a></li>
                </ul>
            </div>
            <div class="navbar-end gap-4">
                @auth
                    <a href="{{ route('fabric.dashboard') }}" class="btn btn-ghost btn-sm font-bold uppercase tracking-widest text-[10px]">Admin</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-ghost btn-sm font-bold uppercase tracking-widest text-[10px]">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm rounded-full px-8 font-black uppercase tracking-widest text-[10px]">Get Started</a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer Component Integration -->
    <x-website.footer />

    @stack('scripts')
</body>
</html>
