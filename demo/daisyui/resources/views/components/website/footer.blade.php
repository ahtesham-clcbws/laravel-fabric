<footer class="bg-base-200 pt-24 border-t border-base-300">
    @inject('settings', 'App\Settings\GeneralSettings')
    
    <div class="container-1300">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-20">
            <!-- Brand Column -->
            <div class="space-y-6">
                <a href="{{ route('home') }}" class="text-3xl font-bold tracking-tighter block">
                    <span class="text-primary">Laravel</span>Fabric
                </a>
                <p class="text-base-content/60 leading-relaxed">
                    {{ $settings->site_description }}
                </p>
                <div class="flex gap-3">
                    <a href="{{ $settings->facebook_url }}" class="btn btn-square btn-sm btn-ghost hover:bg-primary hover:text-primary-content transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                    </a>
                    <a href="{{ $settings->twitter_url }}" class="btn btn-square btn-sm btn-ghost hover:bg-primary hover:text-primary-content transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                    </a>
                </div>
            </div>

            <!-- Services -->
            <div class="space-y-6">
                <h6 class="text-xs font-bold uppercase tracking-[0.2em] text-primary">Our Services</h6> 
                <div class="flex flex-col gap-4">
                    <a href="{{ route('services.index') }}" class="text-sm text-base-content/60 hover:text-primary transition-colors font-semibold">Branding</a>
                    <a href="{{ route('services.index') }}" class="text-sm text-base-content/60 hover:text-primary transition-colors font-semibold">Design</a>
                    <a href="{{ route('services.index') }}" class="text-sm text-base-content/60 hover:text-primary transition-colors font-semibold">Marketing</a>
                </div>
            </div>

            <!-- Company -->
            <div class="space-y-6">
                <h6 class="text-xs font-bold uppercase tracking-[0.2em] text-primary">Company</h6> 
                <div class="flex flex-col gap-4">
                    <a href="{{ route('about') }}" class="text-sm text-base-content/60 hover:text-primary transition-colors font-semibold">About us</a>
                    <a href="{{ route('contact') }}" class="text-sm text-base-content/60 hover:text-primary transition-colors font-semibold">Contact</a>
                    <a href="{{ route('blog.index') }}" class="text-sm text-base-content/60 hover:text-primary transition-colors font-semibold">Blog</a>
                </div>
            </div>

            <!-- Legal -->
            <div class="space-y-6">
                <h6 class="text-xs font-bold uppercase tracking-[0.2em] text-primary">Legal</h6> 
                <div class="flex flex-col gap-4">
                    <a href="{{ route('terms') }}" class="text-sm text-base-content/60 hover:text-primary transition-colors font-semibold">Terms of use</a>
                    <a href="{{ route('privacy') }}" class="text-sm text-base-content/60 hover:text-primary transition-colors font-semibold">Privacy policy</a>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-base-300 py-10 flex flex-col md:flex-row justify-between items-center gap-6 text-xs font-bold text-base-content/40 uppercase tracking-widest">
            <div>
                &copy; {{ date('Y') }} {{ $settings->site_name }}. Forged with Fabric.
            </div>
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                <span>{{ $settings->address }}</span>
            </div>
        </div>
    </div>
</footer>