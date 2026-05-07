<?php

namespace App\Livewire\Fabric\App\Models\Category;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;

/**
 * [FABRIC-METADATA]
 * Model: Category
 * Theme: Tailwind (Advanced)
 * Philosophy: Zero-Dependency Power Table
 */
class CategoryTable extends Component
{
    use WithPagination;

    // Search & Filter State
    public $search = '';
    public $filters = [];
    
    // Sort State
    public $sortField = 'id';
    public $sortDirection = 'desc';

    // UI State
    public $columnVisibility = [];
    public $selected = [];
    public $selectAll = false;
    
    
    

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'id'],
        'sortDirection' => ['except' => 'desc'],
    ];

    public function mount()
    {
        
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selected = $this->getRowsQuery()->pluck('id')->map(fn($id) => (string) $id)->toArray();
        } else {
            $this->selected = [];
        }
    }

    public function getRowsQuery()
    {
        return Category::query()
            
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->orWhere('name', 'like', "%{$this->search}%");
                    $q->orWhere('description', 'like', "%{$this->search}%");

                });
            })
            ->orderBy($this->sortField, $this->sortDirection);
    }

    public function render()
    {
        return view('livewire.fabric.app.models.category.table', [
            'rows' => $this->getRowsQuery()->paginate(10),
        ]);
    }

    
    public function deleteSelected()
    {
        // $this->authorize('deleteAny', Category::class);
        Category::whereIn('id', $this->selected)->delete();
        $this->selected = [];
        $this->dispatch('notify', message: __('Selected records deleted.'));
    }

    public function delete($id)
    {
        // $this->authorize('delete', Category::class);
        Category::find($id)->delete();
        $this->dispatch('notify', message: __('Record deleted successfully.'));
    }

    
}
