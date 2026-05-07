<div class="min-h-screen flex items-center justify-center bg-base-200">
    <div class="card w-full max-w-md bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title justify-center text-2xl font-bold mb-4">{{ __('Create Account') }}</h2>

            <form wire:submit="register">
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">{{ __('Name') }}</legend>
                    <input wire:model="name" type="text" class="input input-bordered w-full" required autofocus />
                    @error('name') <p class="fieldset-label text-error">{{ $message }}</p> @enderror
                </fieldset>

                <fieldset class="fieldset mt-4">
                    <legend class="fieldset-legend">{{ __('Email') }}</legend>
                    <input wire:model="email" type="email" class="input input-bordered w-full" required />
                    @error('email') <p class="fieldset-label text-error">{{ $message }}</p> @enderror
                </fieldset>

                <fieldset class="fieldset mt-4">
                    <legend class="fieldset-legend">{{ __('Password') }}</legend>
                    <input wire:model="password" type="password" class="input input-bordered w-full" required />
                    @error('password') <p class="fieldset-label text-error">{{ $message }}</p> @enderror
                </fieldset>

                <fieldset class="fieldset mt-4">
                    <legend class="fieldset-legend">{{ __('Confirm Password') }}</legend>
                    <input wire:model="password_confirmation" type="password" class="input input-bordered w-full" required />
                </fieldset>

                <div class="card-actions justify-between items-center mt-6">
                    <a href="{{ route('login') }}" class="link link-hover text-sm" wire:navigate>
                        {{ __('Already registered?') }}
                    </a>
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
