<?php

namespace App\Livewire\Fabric\Service;

use LivewireUI\Modal\ModalComponent;
use Livewire\Attributes\Validate;
use App\Models\Service;

/**
 * [FABRIC-METADATA]
 * Model: Service
 * Theme: Tailwind
 */
class Editor extends ModalComponent
{
    /**
     * 🧬 FORGED BY FABRIC
     * The $form array holds the state for all input fields.
     * Use $record for the Eloquent model instance.
     */
    public array $form = [];
    public ?Service $record = null;
    
    
    
    /**
     * 🔍 Dynamic Validation
     * These rules are derived directly from your database schema during forging.
     */

    public function rules()
    {
        return array (
);
    }

    public function mount(Service $record = null)
    {
        $this->record = $record ?: new Service;
        $this->form = $this->record->toArray();
        
        
    }

    public function save()
    {
        // $this->authorize($this->record->exists ? 'update' : 'create', $this->record);
        
        $this->validate();
        $this->record->fill($this->form);
        $this->record->save();

        

        $this->dispatch('service-saved');
        $this->dispatch('closeModal');
    }

    /**
     * [FABRIC-HOOK:REACTIVE-LOGIC]
     */
    

    public function render()
    {
        return view('livewire.fabric.service.editor');
    }
}
