<?php

namespace App\Livewire\Fabric\Faq;

use Livewire\Component;
use App\Models\Faq;

/**
 * [FABRIC-METADATA]
 * Model: Faq
 * Type: Metrics/Stats
 */
class FaqStats extends Component
{
    public function render()
    {
        return view('livewire.fabric.faq.stats', [
            'total' => Faq::count(),
            'latest' => Faq::latest()->take(5)->get(),
            // [FABRIC-HOOK:STATS-LOGIC]
        ]);
    }
}
