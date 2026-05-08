<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="{{ config('fabric.theme_variant', 'light') }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? config('app.name', 'Laravel Blog') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-base-100">
        <x-fabric::navbar-mega />

        <div class="max-w-4xl mx-auto px-4 py-12">
            <!-- Blog Header -->
            <header class="mb-12 text-center">
                <h1 class="text-4xl md:text-6xl font-black mb-4">{{ $headerTitle ?? __('The Fabric Journal') }}</h1>
                <p class="text-xl opacity-60">{{ $headerSubtitle ?? __('Insights into modern Laravel development.') }}</p>
                
                <div class="flex justify-center gap-4 mt-8">
                    @foreach(['Latest', 'Tutorials', 'News', 'Ecosystem'] as $cat)
                        <button class="btn btn-sm btn-outline rounded-full">{{ $cat }}</button>
                    @endforeach
                </div>
            </header>

            <main>
                {{ $slot }}
            </main>
        </div>

        <footer class="footer footer-center p-10 bg-base-200 text-base-content rounded mt-20">
            <nav class="grid grid-flow-col gap-4">
                <a class="link link-hover">About us</a>
                <a class="link link-hover">Contact</a>
                <a class="link link-hover">Jobs</a>
                <a class="link link-hover">Press kit</a>
            </nav> 
            <aside>
                <p>Copyright © {{ date('Y') }} - All right reserved by CLCBWS</p>
            </aside>
        </footer>
    </body>
</html>
