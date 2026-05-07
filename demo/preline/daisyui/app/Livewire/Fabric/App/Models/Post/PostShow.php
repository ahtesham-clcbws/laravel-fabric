<?php

namespace App\Livewire\Fabric\App\Models\Post;

use Livewire\Component;
use App\Models\Post;

/**
 * [FABRIC-METADATA]
 * Model: Post
 * Type: Detail/Show
 */
class PostShow extends Component
{
    public Post $record;

    public function mount(Post $record)
    {
        $this->record = $record;
    }

    public function render()
    {
        return view('livewire.fabric.app.models.post.show');
    }
}
