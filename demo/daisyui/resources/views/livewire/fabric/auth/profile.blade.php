<div class="p-6 bg-base-200 min-h-screen">
    <h1 class="text-3xl font-black uppercase tracking-tighter text-base-content mb-8">{{ __('Profile Settings') }}</h1>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Profile Info -->
        <div class="card bg-base-100 shadow-xl border border-base-300">
            <div class="card-body p-8">
                <h2 class="card-title text-xl font-bold mb-2">{{ __('Profile Information') }}</h2>
                <p class="text-sm opacity-60 mb-8">{{ __("Update your account's profile information and email address.") }}</p>

                <form wire:submit="updateProfileInformation" class="space-y-6">
                    <div class="form-control">
                        <label class="label font-bold text-xs uppercase opacity-50">{{ __('Name') }}</label>
                        <input wire:model="name" type="text" class="input input-bordered w-full rounded-xl" required />
                        @error('name') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-control">
                        <label class="label font-bold text-xs uppercase opacity-50">{{ __('Email') }}</label>
                        <input wire:model="email" type="email" class="input input-bordered w-full rounded-xl" required />
                        @error('email') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="btn btn-primary rounded-xl px-8">{{ __('Save Changes') }}</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Update Password -->
        <div class="card bg-base-100 shadow-xl border border-base-300">
            <div class="card-body p-8">
                <h2 class="card-title text-xl font-bold mb-2">{{ __('Update Password') }}</h2>
                <p class="text-sm opacity-60 mb-8">{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>

                <form wire:submit="updatePassword" class="space-y-6">
                    <div class="form-control">
                        <label class="label font-bold text-xs uppercase opacity-50">{{ __('Current Password') }}</label>
                        <input wire:model="current_password" type="password" class="input input-bordered w-full rounded-xl" required />
                        @error('current_password') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-control">
                        <label class="label font-bold text-xs uppercase opacity-50">{{ __('New Password') }}</label>
                        <input wire:model="password" type="password" class="input input-bordered w-full rounded-xl" required />
                        @error('password') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-control">
                        <label class="label font-bold text-xs uppercase opacity-50">{{ __('Confirm Password') }}</label>
                        <input wire:model="password_confirmation" type="password" class="input input-bordered w-full rounded-xl" required />
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="btn btn-secondary rounded-xl px-8">{{ __('Update Password') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
