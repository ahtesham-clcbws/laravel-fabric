<?php

namespace App\Livewire\Fabric\Faq;

use LivewireUI\Modal\ModalComponent;
use Livewire\Attributes\Validate;
use App\Models\Faq;

/**
 * [FABRIC-METADATA]
 * Model: Faq
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
    public ?Faq $record = null;
    
    
    
    /**
     * 🔍 Dynamic Validation
     * These rules are derived directly from your database schema during forging.
     */

    public function rules()
    {
        return array (
);
    }

    public function mount(Faq $record = null)
    {
        $this->record = $record ?: new Faq;
        $this->form = $this->record->toArray();
        
        
    }

    public function save()
    {
        // $this->authorize($this->record->exists ? 'update' : 'create', $this->record);
        
        $this->validate();
        $this->record->fill($this->form);
        $this->record->save();

        

        $this->dispatch('faq-saved');
        $this->dispatch('closeModal');
    }

    /**
     * [FABRIC-HOOK:REACTIVE-LOGIC]
     */
    

    public function render()
    {
        return view('livewire.fabric.faq.editor');
    }
}
