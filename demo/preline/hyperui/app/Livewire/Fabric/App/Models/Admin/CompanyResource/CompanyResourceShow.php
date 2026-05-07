<?php

namespace App\Livewire\Fabric\App\Models\Admin\CompanyResource;

use Livewire\Component;
use App\Models\Admin\CompanyResource;

/**
 * [FABRIC-METADATA]
 * Model: CompanyResource
 * Type: Detail/Show
 */
class CompanyResourceShow extends Component
{
    public CompanyResource $record;

    public function mount(CompanyResource $record)
    {
        $this->record = $record;
    }

    public function render()
    {
        return view('livewire.fabric.app.models.admin.company-resource.show');
    }
}
