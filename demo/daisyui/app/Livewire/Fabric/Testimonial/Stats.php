<?php

namespace App\Livewire\Fabric\Testimonial;

use Livewire\Component;
use App\Models\Testimonial;

/**
 * [FABRIC-METADATA]
 * Model: Testimonial
 * Type: Metrics/Stats
 */
class TestimonialStats extends Component
{
    public function render()
    {
        return view('livewire.fabric.testimonial.stats', [
            'total' => Testimonial::count(),
            'latest' => Testimonial::latest()->take(5)->get(),
            // [FABRIC-HOOK:STATS-LOGIC]
        ]);
    }
}
