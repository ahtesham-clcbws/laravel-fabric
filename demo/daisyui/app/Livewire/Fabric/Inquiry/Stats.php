<?php

namespace App\Livewire\Fabric\Inquiry;

use Livewire\Component;
use App\Models\Inquiry;

/**
 * [FABRIC-METADATA]
 * Model: Inquiry
 * Type: Metrics/Stats
 */
class InquiryStats extends Component
{
    public function render()
    {
        return view('livewire.fabric.inquiry.stats', [
            'total' => Inquiry::count(),
            'latest' => Inquiry::latest()->take(5)->get(),
            // [FABRIC-HOOK:STATS-LOGIC]
        ]);
    }
}
