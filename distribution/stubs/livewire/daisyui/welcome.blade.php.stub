<x-web-layout>
    <!-- Hero -->
    <section class="py-12 px-4 max-w-7xl mx-auto">
        <x-fabric::hero 
            title="Laravel Fabric v2026"
            description="The most powerful scaffolding engine for Laravel 13. Build admin panels, user dashboards, and public websites with a single command."
            primaryText="Deploy Now"
            secondaryText="Watch Demo"
        />
    </section>

    <!-- Stats -->
    <section class="py-12 px-4 max-w-7xl mx-auto">
        <x-fabric::stats-v2 :stats="[
            ['label' => 'Total Downloads', 'value' => '45.6K', 'icon' => '<svg xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\" viewBox=\"0 0 24 24\" class=\"inline-block w-8 h-8 stroke-current\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z\"></path></svg>', 'color' => 'primary', 'description' => 'Jan 1st - Feb 1st'],
            ['label' => 'New Users', 'value' => '2,100', 'icon' => '<svg xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\" viewBox=\"0 0 24 24\" class=\"inline-block w-8 h-8 stroke-current\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4\"></path></svg>', 'color' => 'secondary', 'description' => '↗︎ 400 (22%)'],
            ['label' => 'New Registers', 'value' => '1,200', 'icon' => '<svg xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\" viewBox=\"0 0 24 24\" class=\"inline-block w-8 h-8 stroke-current\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4\"></path></svg>', 'color' => 'accent', 'description' => '↘︎ 90 (14%)']
        ]" />
    </section>

    <!-- Pricing -->
    <section class="py-20 bg-base-200">
        <div class="max-w-7xl mx-auto px-4 text-center mb-16">
            <h2 class="text-4xl font-bold mb-4">{{ __('Transparent Pricing') }}</h2>
            <p class="text-lg text-base-content/60">{{ __('Choose the plan that fits your project needs.') }}</p>
        </div>
        <div class="max-w-7xl mx-auto px-4">
            <x-fabric::pricing :plans="[
                [
                    'name' => 'Starter',
                    'price' => '$0',
                    'period' => 'mo',
                    'description' => 'Perfect for small side projects.',
                    'features' => ['1 Theme', 'Basic Auth', 'CRUD Generation', 'Community Support'],
                    'buttonText' => 'Get Started',
                    'featured' => false
                ],
                [
                    'name' => 'Professional',
                    'price' => '$29',
                    'period' => 'mo',
                    'description' => 'Best for freelancers and agencies.',
                    'features' => ['All Themes', 'Identity Engine', 'Team Collaboration', 'Priority Support', 'Custom Stubs'],
                    'buttonText' => 'Choose Pro',
                    'featured' => true
                ],
                [
                    'name' => 'Enterprise',
                    'price' => '$99',
                    'period' => 'mo',
                    'description' => 'For large scale applications.',
                    'features' => ['Unlimited Everything', 'Dedicated Support', 'SLA Guarantee', 'On-premise deployment'],
                    'buttonText' => 'Contact Sales',
                    'featured' => false
                ]
            ]" />
        </div>
    </section>

    <!-- FAQ -->
    <section class="py-20 bg-base-100">
        <div class="max-w-4xl mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-16">{{ __('Frequently Asked') }}</h2>
            <x-fabric::faq :items="[
                ['question' => 'Does it support Laravel 13?', 'answer' => 'Yes, it is built specifically for Laravel 13 and Livewire 4.'],
                ['question' => 'Can I customize the stubs?', 'answer' => 'Absolutely. Use fabric:stubs to publish them and override anything.'],
                ['question' => 'Is it free for commercial use?', 'answer' => 'Yes, under the MIT license.']
            ]" />
        </div>
    </section>

    <!-- Contact -->
    <section class="py-20 px-4 max-w-xl mx-auto">
        <x-fabric::contact />
    </section>
</x-web-layout>
