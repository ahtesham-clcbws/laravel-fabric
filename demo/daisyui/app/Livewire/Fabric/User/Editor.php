<?php

namespace App\Livewire\Fabric\User;

use LivewireUI\Modal\ModalComponent;
use Livewire\Attributes\Validate;
use App\Models\User;

/**
 * [FABRIC-METADATA]
 * Model: User
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
    public ?User $record = null;
    
    
    
    /**
     * 🔍 Dynamic Validation
     * These rules are derived directly from your database schema during forging.
     */

    public function rules()
    {
        return array (
  'form.name' => 
  array (
    0 => 'required',
    1 => 'max:255',
  ),
  'form.email' => 
  array (
    0 => 'required',
    1 => 'max:255',
    2 => 'email',
  ),
);
    }

    public function mount(User $record = null)
    {
        $this->record = $record ?: new User;
        $this->form = $this->record->toArray();
        
        
    }

    public function save()
    {
        // $this->authorize($this->record->exists ? 'update' : 'create', $this->record);
        
        $this->validate();
        $this->record->fill($this->form);
        $this->record->save();

        

        $this->dispatch('user-saved');
        $this->dispatch('closeModal');
    }

    /**
     * [FABRIC-HOOK:REACTIVE-LOGIC]
     */
    
    public function updatedFormName($value)
    {
        // Add dependent field logic here
    }

    public function updatedFormEmail($value)
    {
        // Add dependent field logic here
    }


    public function render()
    {
        return view('livewire.fabric.user.editor');
    }
}
