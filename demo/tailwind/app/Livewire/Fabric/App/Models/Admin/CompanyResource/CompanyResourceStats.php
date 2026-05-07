<?php

namespace App\Livewire\Fabric\Admin\CompanyResource;

use Livewire\Component;
use App\Models\Admin\CompanyResource;

/**
 * [FABRIC-METADATA]
 * Model: CompanyResource
 * Type: Metrics/Stats
 */
class CompanyResourceStats extends Component
{
    public function render()
    {
        return view('livewire.fabric.admin.company-resource.stats', [
            'total' => CompanyResource::count(),
            'latest' => CompanyResource::latest()->take(5)->get(),
            // [FABRIC-HOOK:STATS-LOGIC]
        ]);
    }
}
