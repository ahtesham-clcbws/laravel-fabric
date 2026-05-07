<!DOCTYPE html>
<html class="h-full bg-gray-50" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Fabric</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net" rel="preconnect">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>

    <body class="h-full font-sans antialiased">
        <div class="min-h-full">
            <nav class="border-b border-gray-200 bg-white">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 justify-between">
                        <div class="flex">
                            <div class="flex flex-shrink-0 items-center">
                                <span class="text-xl font-bold text-indigo-600">Fabric.</span>
                            </div>
                            <div class="hidden sm:-my-px sm:ml-6 sm:flex sm:space-x-8">
                                <a class="{{ request()->is('posts*') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium"
                                    href="/posts">
                                    Posts
                                </a>
                                <a class="{{ request()->is('categories*') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium"
                                    href="/categories">
                                    Categories
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="py-10">
                <header>
                    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <h1 class="text-3xl font-bold leading-tight text-gray-900">
                            {{ $title ?? 'Management' }}
                        </h1>
                    </div>
                </header>
                <main>
                    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                        <div class="px-4 py-8 sm:px-0">
                            {{ $slot }}
                        </div>
                    </div>
                </main>
            </div>
        </div>

        @livewireScripts
        @livewire('wire-elements-modal')
    </body>

</html>
