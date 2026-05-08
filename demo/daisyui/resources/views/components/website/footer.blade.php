<footer class="bg-base-200 pt-32 pb-16 border-t border-base-300">
    @inject('settings', 'App\Settings\GeneralSettings')
    
    <div class="container-1300">
        <!-- Main Footer Content: Explicit Flex for Guaranteed Columns -->
        <div class="flex flex-wrap justify-between gap-y-16 -mx-4 mb-24">
            
            <!-- Brand Column -->
            <div class="w-full lg:w-2/5 px-4 space-y-10">
                <a href="{{ route('home') }}" class="text-4xl font-black tracking-tighter block">
                    <span class="text-primary">Laravel</span>Fabric
                </a>
                <p class="text-base-content/50 leading-relaxed text-xl max-w-sm font-medium">
                    {{ $settings->site_description }} The future of administrative interface design.
                </p>
                <div class="flex gap-4">
                    <a href="{{ $settings->facebook_url }}" class="btn btn-square btn-lg btn-ghost hover:bg-primary hover:text-primary-content transition-all border border-base-300 rounded-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                    </a>
                    <a href="{{ $settings->twitter_url }}" class="btn btn-square btn-lg btn-ghost hover:bg-primary hover:text-primary-content transition-all border border-base-300 rounded-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                    </a>
                </div>
            </div>

            <!-- Links Container -->
            <div class="w-full lg:w-3/5 px-4">
                <div class="grid grid-cols-2 md:grid-cols-3 gap-12">
                    <!-- Services -->
                    <div class="space-y-8">
                        <h6 class="text-xs font-black uppercase tracking-[0.4em] text-primary">Services</h6> 
                        <ul class="space-y-5">
                            <li><a href="{{ route('services.index') }}" class="text-base-content/60 hover:text-primary transition-colors font-bold text-base">Web Forge</a></li>
                            <li><a href="{{ route('services.index') }}" class="text-base-content/60 hover:text-primary transition-colors font-bold text-base">UI Strategy</a></li>
                            <li><a href="{{ route('services.index') }}" class="text-base-content/60 hover:text-primary transition-colors font-bold text-base">Cloud Matrix</a></li>
                        </ul>
                    </div>

                    <!-- Company -->
                    <div class="space-y-8">
                        <h6 class="text-xs font-black uppercase tracking-[0.4em] text-primary">Company</h6> 
                        <ul class="space-y-5">
                            <li><a href="{{ route('about') }}" class="text-base-content/60 hover:text-primary transition-colors font-bold text-base">Our Story</a></li>
                            <li><a href="{{ route('contact') }}" class="text-base-content/60 hover:text-primary transition-colors font-bold text-base">Contact</a></li>
                            <li><a href="{{ route('blog.index') }}" class="text-base-content/60 hover:text-primary transition-colors font-bold text-base">Dispatch</a></li>
                        </ul>
                    </div>

                    <!-- Legal -->
                    <div class="space-y-8">
                        <h6 class="text-xs font-black uppercase tracking-[0.4em] text-primary">Security</h6> 
                        <ul class="space-y-5">
                            <li><a href="{{ route('terms') }}" class="text-base-content/60 hover:text-primary transition-colors font-bold text-base">Terms</a></li>
                            <li><a href="{{ route('privacy') }}" class="text-base-content/60 hover:text-primary transition-colors font-bold text-base">Privacy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="pt-16 border-t border-base-300 flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="text-[11px] font-black uppercase tracking-[0.5em] text-base-content/20">
                &copy; {{ date('Y') }} Laravel Fabric. Engineered for Elite Performance.
            </div>
            <div class="flex items-center gap-4 text-xs font-black text-base-content/30 uppercase tracking-widest">
                <span>{{ $settings->address }}</span>
            </div>
        </div>
    </div>
</footer>