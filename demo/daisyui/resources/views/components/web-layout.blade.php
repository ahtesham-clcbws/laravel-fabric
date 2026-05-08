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
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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
<body class="min-h-screen bg-base-100 antialiased">
    <!-- Navbar -->
    <div class="navbar bg-base-100/80 backdrop-blur-md sticky top-0 z-50 border-b border-base-200">
        <div class="container-1300 flex items-center justify-between">
            <div class="navbar-start">
                <div class="dropdown">
                    <label tabindex="0" class="btn btn-ghost lg:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" /></svg>
                    </label>
                    <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('about') }}">About</a></li>
                        <li><a href="{{ route('services.index') }}">Services</a></li>
                        <li><a href="{{ route('blog.index') }}">Blog</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>
                <a href="{{ route('home') }}" class="text-2xl font-bold tracking-tighter">
                    <span class="text-primary">Laravel</span>Fabric
                </a>
            </div>
            <div class="navbar-center hidden lg:flex">
                <ul class="menu menu-horizontal px-1 font-medium gap-2">
                    <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                    <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
                    <li><a href="{{ route('services.index') }}" class="{{ request()->routeIs('services.*') ? 'active' : '' }}">Services</a></li>
                    <li><a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">Blog</a></li>
                    <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
                </ul>
            </div>
            <div class="navbar-end gap-2">
                @auth
                    <a href="{{ route('fabric.dashboard') }}" class="btn btn-ghost btn-sm">Admin</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-ghost btn-sm">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm rounded-full px-6">Get Started</a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-base-200 mt-20">
        <div class="container-1300 footer p-10 text-base-content py-20">
            <aside>
                <div class="text-3xl font-bold tracking-tighter mb-4">
                    <span class="text-primary">Laravel</span>Fabric
                </div>
                <p>{{ $settings->site_name }}<br/>{{ $settings->site_description }}</p>
            </aside> 
            <nav>
                <h6 class="footer-title opacity-50 uppercase tracking-widest">Services</h6> 
                <a href="{{ route('services.index') }}" class="link link-hover">Branding</a>
                <a href="{{ route('services.index') }}" class="link link-hover">Design</a>
                <a href="{{ route('services.index') }}" class="link link-hover">Marketing</a>
            </nav> 
            <nav>
                <h6 class="footer-title opacity-50 uppercase tracking-widest">Company</h6> 
                <a href="{{ route('about') }}" class="link link-hover">About us</a>
                <a href="{{ route('contact') }}" class="link link-hover">Contact</a>
                <a href="{{ route('blog.index') }}" class="link link-hover">Blog</a>
            </nav> 
            <nav>
                <h6 class="footer-title opacity-50 uppercase tracking-widest">Legal</h6> 
                <a href="{{ route('terms') }}" class="link link-hover">Terms of use</a>
                <a href="{{ route('privacy') }}" class="link link-hover">Privacy policy</a>
            </nav>
        </div>
        <div class="border-t border-base-300">
            <div class="container-1300 footer py-4 text-base-content">
                <aside class="items-center grid-flow-col">
                    <p>&copy; {{ date('Y') }} {{ $settings->site_name }}. All rights reserved.</p>
                </aside> 
                <nav class="md:place-self-center md:justify-self-end">
                    <div class="grid grid-flow-col gap-4">
                        <span>{{ $settings->address }}</span>
                    </div>
                </nav>
            </div>
        </div>
    </footer>
</body>
</html>
