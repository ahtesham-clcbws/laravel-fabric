<?php

namespace App\Livewire\Fabric\Testimonial;

use Livewire\Component;
use App\Models\Testimonial;

/**
 * [FABRIC-METADATA]
 * Model: Testimonial
 * Type: Detail/Show
 */
class TestimonialShow extends Component
{
    public Testimonial $record;

    public function mount(Testimonial $record)
    {
        $this->record = $record;
    }

    public function render()
    {
        return view('livewire.fabric.testimonial.show');
    }
}
