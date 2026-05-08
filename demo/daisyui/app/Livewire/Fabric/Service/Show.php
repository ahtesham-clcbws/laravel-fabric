<?php

namespace App\Livewire\Fabric\Service;

use Livewire\Component;
use App\Models\Service;

/**
 * [FABRIC-METADATA]
 * Model: Service
 * Type: Detail/Show
 */
class ServiceShow extends Component
{
    public Service $record;

    public function mount(Service $record)
    {
        $this->record = $record;
    }

    public function render()
    {
        return view('livewire.fabric.service.show');
    }
}
