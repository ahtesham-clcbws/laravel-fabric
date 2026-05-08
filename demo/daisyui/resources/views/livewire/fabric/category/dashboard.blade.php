<x-app-layout>
    <div class="p-6 bg-base-200 min-h-screen">
        <h1 class="text-3xl font-bold mb-6 text-base-content">{{ __('Dashboard') }}</h1>
        
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <p class="text-lg text-base-content">{{ __("You're logged in!") }}</p>
                <div class="card-actions justify-end mt-4">
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">
                        {{ __('Get Started') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
