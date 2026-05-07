<?php

namespace App\Livewire\Fabric\App\Models\Category;

use LivewireUI\Modal\ModalComponent;
use Livewire\Attributes\Validate;
use App\Models\Category;

/**
 * [FABRIC-METADATA]
 * Model: Category
 * Theme: Tailwind
 */
class CategoryEditor extends ModalComponent
{
    public array $form = [];
    public ?Category $record = null;
    
    

    public function rules()
    {
        return array (
  'form.name' => 
  array (
    0 => 'required',
  ),
  'form.description' => 
  array (
    0 => 'required',
  ),
);
    }

    public function mount(Category $record = null)
    {
        $this->record = $record ?: new Category;
        $this->form = $this->record->toArray();
        
        
    }

    public function save()
    {
        // $this->authorize($this->record->exists ? 'update' : 'create', $this->record);
        
        $this->validate();
        $this->record->fill($this->form);
        $this->record->save();

        

        $this->dispatch('category-saved');
        $this->dispatch('closeModal');
    }

    /**
     * [FABRIC-HOOK:REACTIVE-LOGIC]
     */
    
    public function updatedFormName($value)
    {
        // Add dependent field logic here
    }

    public function updatedFormDescription($value)
    {
        // Add dependent field logic here
    }


    public function render()
    {
        return view('livewire.fabric.app.models.category.editor');
    }
}
