<div class="card bg-base-100 shadow-2xl border border-base-200">
    <div class="card-body p-8 lg:p-12">
        <h2 class="text-3xl font-bold tracking-tighter mb-8">Send us a <span class="text-primary italic">Message</span></h2>
        
        @if (session()->has('success'))
            <div class="alert alert-success shadow-lg mb-8 rounded-2xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <form wire:submit="submit" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="form-control w-full">
                    <label class="label"><span class="label-text font-bold uppercase tracking-widest text-xs opacity-50">Your Name</span></label>
                    <input type="text" wire:model="name" placeholder="John Doe" class="input input-bordered w-full rounded-xl @error('name') input-error @enderror" />
                    @error('name') <label class="label"><span class="label-text-alt text-error font-bold">{{ $message }}</span></label> @enderror
                </div>
                <div class="form-control w-full">
                    <label class="label"><span class="label-text font-bold uppercase tracking-widest text-xs opacity-50">Email Address</span></label>
                    <input type="email" wire:model="email" placeholder="john@example.com" class="input input-bordered w-full rounded-xl @error('email') input-error @enderror" />
                    @error('email') <label class="label"><span class="label-text-alt text-error font-bold">{{ $message }}</span></label> @enderror
                </div>
            </div>

            <div class="form-control w-full">
                <label class="label"><span class="label-text font-bold uppercase tracking-widest text-xs opacity-50">Subject</span></label>
                <input type="text" wire:model="subject" placeholder="How can we help?" class="input input-bordered w-full rounded-xl" />
            </div>

            <div class="form-control w-full">
                <label class="label"><span class="label-text font-bold uppercase tracking-widest text-xs opacity-50">Message</span></label>
                <textarea wire:model="message" class="textarea textarea-bordered h-32 rounded-xl @error('message') textarea-error @enderror" placeholder="Tell us more about your project..."></textarea>
                @error('message') <label class="label"><span class="label-text-alt text-error font-bold">{{ $message }}</span></label> @enderror
            </div>

            <div class="card-actions justify-end mt-8">
                <button type="submit" class="btn btn-primary btn-wide rounded-full shadow-xl shadow-primary/20" wire:loading.attr="disabled">
                    <span wire:loading.remove>Send Message</span>
                    <span wire:loading><span class="loading loading-spinner loading-sm"></span> Sending...</span>
                </button>
            </div>
        </form>
    </div>
</div>
