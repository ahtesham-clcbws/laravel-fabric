@props([
    'title',
    'breadcrumbs' => []
])

<div class="md:flex md:items-center md:justify-between mb-8 border-b border-gray-200 pb-6">
    <div class="min-w-0 flex-1">
        <!-- Breadcrumbs -->
        <nav class="flex mb-2" aria-label="Breadcrumb">
            <ol role="list" class="flex items-center space-x-2">
                <li>
                    <div class="flex items-center">
                        <a href="#" class="text-xs font-medium text-gray-500 hover:text-gray-700">Dashboard</a>
                    </div>
                </li>
                @foreach($breadcrumbs as $label => $link)
                    <li>
                        <div class="flex items-center">
                            <svg class="h-5 w-5 flex-shrink-0 text-gray-300" viewBox="0 0 20 20" fill="currentColor"><path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" /></svg>
                            <a href="{{ $link }}" class="ml-2 text-xs font-medium text-gray-500 hover:text-gray-700">{{ $label }}</a>
                        </div>
                    </li>
                @endforeach
            </ol>
        </nav>
        
        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
            {{ $title }}
        </h2>
    </div>
    
    <div class="mt-4 flex md:ml-4 md:mt-0 gap-3">
        {{ $actions ?? '' }}
    </div>
</div>
