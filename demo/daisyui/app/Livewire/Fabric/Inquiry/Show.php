<?php

namespace App\Livewire\Fabric\Inquiry;

use Livewire\Component;
use App\Models\Inquiry;

/**
 * [FABRIC-METADATA]
 * Model: Inquiry
 * Type: Detail/Show
 */
class InquiryShow extends Component
{
    public Inquiry $record;

    public function mount(Inquiry $record)
    {
        $this->record = $record;
    }

    public function render()
    {
        return view('livewire.fabric.inquiry.show');
    }
}
