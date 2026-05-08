<?php

namespace App\Livewire\Fabric\Post;

use LivewireUI\Modal\ModalComponent;
use Livewire\Attributes\Validate;
use App\Models\Post;

/**
 * [FABRIC-METADATA]
 * Model: Post
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
    public ?Post $record = null;
    
        public $categories = [];

    
    /**
     * 🔍 Dynamic Validation
     * These rules are derived directly from your database schema during forging.
     */

    public function rules()
    {
        return array (
  'form.category_id' => 
  array (
    0 => 'required',
    1 => 'integer',
    2 => 'exists:categories,id',
  ),
  'form.title' => 
  array (
    0 => 'required',
    1 => 'max:255',
  ),
  'form.content' => 
  array (
    0 => 'required',
  ),
  'form.is_published' => 
  array (
    0 => 'nullable',
  ),
  'form.published_at' => 
  array (
    0 => 'nullable',
  ),
  'form.meta_data' => 
  array (
    0 => 'nullable',
  ),
);
    }

    public function mount(Post $record = null)
    {
        $this->record = $record ?: new Post;
        $this->form = $this->record->toArray();
        
                $this->categories = \App\Models\Category::all();

    }

    public function save()
    {
        // $this->authorize($this->record->exists ? 'update' : 'create', $this->record);
        
        $this->validate();
        $this->record->fill($this->form);
        $this->record->save();

        

        $this->dispatch('post-saved');
        $this->dispatch('closeModal');
    }

    /**
     * [FABRIC-HOOK:REACTIVE-LOGIC]
     */
    
    public function updatedFormCategoryId($value)
    {
        // Add dependent field logic here
    }

    public function updatedFormTitle($value)
    {
        // Add dependent field logic here
    }

    public function updatedFormContent($value)
    {
        // Add dependent field logic here
    }

    public function updatedFormIsPublished($value)
    {
        // Add dependent field logic here
    }

    public function updatedFormPublishedAt($value)
    {
        // Add dependent field logic here
    }

    public function updatedFormMetaData($value)
    {
        // Add dependent field logic here
    }


    public function render()
    {
        return view('livewire.fabric.post.editor');
    }
}
