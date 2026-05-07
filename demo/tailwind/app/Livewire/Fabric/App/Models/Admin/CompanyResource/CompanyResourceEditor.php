<?php

namespace App\Livewire\Fabric\Admin\CompanyResource;

use LivewireUI\Modal\ModalComponent;
use Livewire\Attributes\Validate;
use App\Models\Admin\CompanyResource;

/**
 * [FABRIC-METADATA]
 * Model: CompanyResource
 * Theme: Tailwind
 */
class CompanyResourceEditor extends ModalComponent
{
    public array $form = [];
    public ?CompanyResource $record = null;
    
        public $categories = [];


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
  'form.email' => 
  array (
    0 => 'required',
  ),
  'form.active' => 
  array (
    0 => 'required',
  ),
  'form.founded_at' => 
  array (
    0 => 'required',
  ),
  'form.last_audit_at' => 
  array (
    0 => 'required',
  ),
  'form.settings' => 
  array (
    0 => 'required',
  ),
  'form.type' => 
  array (
    0 => 'required',
  ),
  'form.category_id' => 
  array (
    0 => 'required',
  ),
);
    }

    public function mount(CompanyResource $record = null)
    {
        $this->record = $record ?: new CompanyResource;
        $this->form = $this->record->toArray();
        
                $this->categories = \App\Models\Category::all();

    }

    public function save()
    {
        // $this->authorize($this->record->exists ? 'update' : 'create', $this->record);
        
        $this->validate();
        $this->record->fill($this->form);
        $this->record->save();

        

        $this->dispatch('companyResource-saved');
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

    public function updatedFormEmail($value)
    {
        // Add dependent field logic here
    }

    public function updatedFormActive($value)
    {
        // Add dependent field logic here
    }

    public function updatedFormFoundedAt($value)
    {
        // Add dependent field logic here
    }

    public function updatedFormLastAuditAt($value)
    {
        // Add dependent field logic here
    }

    public function updatedFormSettings($value)
    {
        // Add dependent field logic here
    }

    public function updatedFormType($value)
    {
        // Add dependent field logic here
    }

    public function updatedFormCategoryId($value)
    {
        // Add dependent field logic here
    }


    public function render()
    {
        return view('livewire.fabric.admin.company-resource.editor');
    }
}
