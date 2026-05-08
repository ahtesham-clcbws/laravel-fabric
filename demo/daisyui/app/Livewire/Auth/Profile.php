<?php

namespace App\Livewire\Fabric\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Profile extends Component
{
    public string $name = '';
    public string $email = '';
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    public function updatePassword(): void
    {
        $validated = $this->validate([
            'current_password' => ['required', 'string', 'current_password'],
            'password' => ['required', 'string', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
        ]);

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');
    }
    public function logoutOtherDevices(): void
    {
        $this->validate([
            'current_password' => ['required', 'string', 'current_password'],
        ]);

        Auth::logoutOtherDevices($this->current_password);

        $this->dispatch('sessions-invalidated');
    }

    public function generateApiKey(): void
    {
        $token = \Illuminate\Support\Str::random(64);
        
        Auth::user()->api_tokens()->create([
            'name' => 'Forged Key',
            'token' => hash('sha256', $token),
        ]);

        $this->dispatch('token-generated', token: $token);
    }

    public function revokeApiKey(int $id): void
    {
        Auth::user()->api_tokens()->where('id', $id)->delete();
        $this->dispatch('token-revoked');
    }

    public function render()
    {
        return view('livewire.fabric.auth.profile');
    }
}
