<?php

namespace App\Livewire\Fabric\User;

use Livewire\Component;
use App\Models\User;

/**
 * [FABRIC-METADATA]
 * Model: User
 * Type: Metrics/Stats
 */
class UserStats extends Component
{
    public function render()
    {
        return view('livewire.fabric.user.stats', [
            'total' => User::count(),
            'latest' => User::latest()->take(5)->get(),
            // [FABRIC-HOOK:STATS-LOGIC]
        ]);
    }
}
