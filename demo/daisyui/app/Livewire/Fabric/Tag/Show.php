<?php

namespace App\Livewire\Fabric\Tag;

use Livewire\Component;
use App\Models\Tag;

/**
 * [FABRIC-METADATA]
 * Model: Tag
 * Type: Detail/Show
 */
class TagShow extends Component
{
    public Tag $record;

    public function mount(Tag $record)
    {
        $this->record = $record;
    }

    public function render()
    {
        return view('livewire.fabric.tag.show');
    }
}
