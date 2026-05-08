<?php

namespace App\Livewire\Fabric\User;

use Livewire\Component;
use App\Models\User;

/**
 * [FABRIC-METADATA]
 * Model: User
 * Type: Detail/Show
 */
class UserShow extends Component
{
    public User $record;

    public function mount(User $record)
    {
        $this->record = $record;
    }

    public function render()
    {
        return view('livewire.fabric.user.show');
    }
}
