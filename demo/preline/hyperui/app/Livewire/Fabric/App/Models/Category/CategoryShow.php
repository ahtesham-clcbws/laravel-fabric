<?php

namespace App\Livewire\Fabric\App\Models\Category;

use Livewire\Component;
use App\Models\Category;

/**
 * [FABRIC-METADATA]
 * Model: Category
 * Type: Detail/Show
 */
class CategoryShow extends Component
{
    public Category $record;

    public function mount(Category $record)
    {
        $this->record = $record;
    }

    public function render()
    {
        return view('livewire.fabric.app.models.category.show');
    }
}
