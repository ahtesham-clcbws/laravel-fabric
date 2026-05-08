<?php

namespace App\Livewire\Fabric\Tag;

use Livewire\Component;
use App\Models\Tag;

/**
 * [FABRIC-METADATA]
 * Model: Tag
 * Type: Metrics/Stats
 */
class TagStats extends Component
{
    public function render()
    {
        return view('livewire.fabric.tag.stats', [
            'total' => Tag::count(),
            'latest' => Tag::latest()->take(5)->get(),
            // [FABRIC-HOOK:STATS-LOGIC]
        ]);
    }
}
