<?php

namespace App\Livewire\Fabric\Service;

use Livewire\Component;
use App\Models\Service;

/**
 * [FABRIC-METADATA]
 * Model: Service
 * Type: Metrics/Stats
 */
class ServiceStats extends Component
{
    public function render()
    {
        return view('livewire.fabric.service.stats', [
            'total' => Service::count(),
            'latest' => Service::latest()->take(5)->get(),
            // [FABRIC-HOOK:STATS-LOGIC]
        ]);
    }
}
