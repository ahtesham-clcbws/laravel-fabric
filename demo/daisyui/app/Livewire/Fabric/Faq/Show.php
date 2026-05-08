<?php

namespace App\Livewire\Fabric\Faq;

use Livewire\Component;
use App\Models\Faq;

/**
 * [FABRIC-METADATA]
 * Model: Faq
 * Type: Detail/Show
 */
class FaqShow extends Component
{
    public Faq $record;

    public function mount(Faq $record)
    {
        $this->record = $record;
    }

    public function render()
    {
        return view('livewire.fabric.faq.show');
    }
}
