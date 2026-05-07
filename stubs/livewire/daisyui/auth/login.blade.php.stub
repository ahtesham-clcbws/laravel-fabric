<div class="min-h-screen flex items-center justify-center bg-base-200">
    <div class="card w-full max-w-md bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title justify-center text-2xl font-bold mb-4">{{ __('Login to :app', ['app' => config('app.name')]) }}</h2>

            <form wire:submit="login">
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">{{ __('Email') }}</legend>
                    <input wire:model="email" type="email" class="input input-bordered w-full" placeholder="email@example.com" required autofocus />
                    @error('email') <p class="fieldset-label text-error">{{ $message }}</p> @enderror
                </fieldset>

                <fieldset class="fieldset mt-4">
                    <legend class="fieldset-legend">{{ __('Password') }}</legend>
                    <input wire:model="password" type="password" class="input input-bordered w-full" required />
                    @error('password') <p class="fieldset-label text-error">{{ $message }}</p> @enderror
                </fieldset>

                <div class="form-control mt-4">
                    <label class="label cursor-pointer justify-start gap-2">
                        <input wire:model="remember" type="checkbox" class="checkbox checkbox-primary" />
                        <span class="label-text">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="card-actions justify-between items-center mt-6">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="link link-hover text-sm" wire:navigate>
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                    <button type="submit" class="btn btn-primary">
                        <span wire:loading class="loading loading-spinner"></span>
                        {{ __('Log in') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
