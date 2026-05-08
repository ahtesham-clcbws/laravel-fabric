<?php

namespace App\Livewire\Fabric\Category;

use Livewire\Component;
use App\Models\Category;

/**
 * [FABRIC-METADATA]
 * Model: Category
 * Type: Metrics/Stats
 */
class CategoryStats extends Component
{
    public function render()
    {
        return view('livewire.fabric.category.stats', [
            'total' => Category::count(),
            'latest' => Category::latest()->take(5)->get(),
            // [FABRIC-HOOK:STATS-LOGIC]
        ]);
    }
}
