<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="{{ config('fabric.theme_variant', 'light') }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-base-100">
        <!-- Navbar -->
        <div class="navbar bg-base-100 shadow-sm sticky top-0 z-50">
            <div class="navbar-start">
                <div class="dropdown">
                    <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" /></svg>
                    </div>
                    <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                        <li><a>{{ __('Home') }}</a></li>
                        <li><a>{{ __('Products') }}</a></li>
                        <li><a>{{ __('Pricing') }}</a></li>
                    </ul>
                </div>
                <a href="/" class="btn btn-ghost text-xl font-bold italic tracking-tighter">
                    <span class="text-primary">L</span>ARAVEL <span class="text-secondary">F</span>ABRIC
                </a>
            </div>
            <div class="navbar-center hidden lg:flex">
                <ul class="menu menu-horizontal px-1">
                    <li><a>{{ __('Home') }}</a></li>
                    <li><a>{{ __('Products') }}</a></li>
                    <li><a>{{ __('Pricing') }}</a></li>
                </ul>
            </div>
            <div class="navbar-end gap-2">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">{{ __('Dashboard') }}</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-ghost">{{ __('Login') }}</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">{{ __('Get Started') }}</a>
                @endauth
            </div>
        </div>

        <!-- Main Content -->
        <main>
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="footer p-10 bg-base-200 text-base-content mt-20">
            <nav>
                <h6 class="footer-title">{{ __('Services') }}</h6> 
                <a class="link link-hover">Branding</a>
                <a class="link link-hover">Design</a>
                <a class="link link-hover">Marketing</a>
                <a class="link link-hover">Advertisement</a>
            </nav> 
            <nav>
                <h6 class="footer-title">{{ __('Company') }}</h6> 
                <a class="link link-hover">About us</a>
                <a class="link link-hover">Contact</a>
                <a class="link link-hover">Jobs</a>
                <a class="link link-hover">Press kit</a>
            </nav> 
            <nav>
                <h6 class="footer-title">{{ __('Legal') }}</h6> 
                <a class="link link-hover">Terms of use</a>
                <a class="link link-hover">Privacy policy</a>
                <a class="link link-hover">Cookie policy</a>
            </nav>
        </footer>
    </body>
</html>
