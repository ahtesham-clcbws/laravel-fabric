<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - SaaS Layout</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="h-full font-sans antialiased text-gray-900 overflow-hidden">
    <div class="flex h-full">
        <!-- Narrow Icon Sidebar -->
        <div class="flex w-16 flex-col items-center overflow-y-auto bg-indigo-600 py-4">
            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600">
                <span class="text-white font-bold">F</span>
            </div>
            <nav class="mt-8 flex flex-1 flex-col gap-y-4">
                <a href="#" class="group flex h-10 w-10 items-center justify-center rounded-lg text-indigo-200 hover:bg-indigo-800 hover:text-white transition">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" /></svg>
                </a>
                <!-- [FABRIC-HOOK:ICON-NAV] -->
            </nav>
        </div>

        <!-- Main Content Column -->
        <div class="flex flex-1 flex-col overflow-y-auto bg-gray-50">
            <header class="flex h-16 items-center justify-between border-b border-gray-200 bg-white px-8">
                <h1 class="text-lg font-semibold">{{ $header ?? 'Dashboard' }}</h1>
                <div class="flex items-center gap-4">
                    <!-- Global Search or Profile -->
                </div>
            </header>
            <main class="p-8">
                {{ $slot }}
            </main>
        </div>
    </div>
    @livewireStyles
</body>
</html>
