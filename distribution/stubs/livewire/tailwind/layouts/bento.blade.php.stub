<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-50/50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - Bento</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="h-full font-sans antialiased text-gray-900">
    <div class="p-4 sm:p-6 lg:p-8">
        <header class="mb-10 flex items-center justify-between">
            <h1 class="text-2xl font-bold tracking-tight text-gray-900">{{ $header ?? 'Overview' }}</h1>
            <div class="flex items-center gap-3">
                <span class="text-sm font-medium text-gray-500">{{ now()->format('l, F j') }}</span>
                <div class="h-10 w-10 rounded-full bg-indigo-100 border-2 border-white shadow-sm"></div>
            </div>
        </header>

        <main class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
            <!-- Full width slot for tables/large widgets -->
            <div class="md:col-span-2 lg:col-span-4">
                {{ $slot }}
            </div>
        </main>
    </div>
    @livewireScripts
</body>
</html>
