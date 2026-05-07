<?php

namespace App\Livewire\Fabric\App\Models\Post;

use Livewire\Component;
use App\Models\Post;

/**
 * [FABRIC-METADATA]
 * Model: Post
 * Type: Metrics/Stats
 */
class PostStats extends Component
{
    public function render()
    {
        return view('livewire.fabric.app.models.post.stats', [
            'total' => Post::count(),
            'latest' => Post::latest()->take(5)->get(),
            // [FABRIC-HOOK:STATS-LOGIC]
        ]);
    }
}
