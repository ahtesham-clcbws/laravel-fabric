<?php

namespace App\Livewire\Fabric\App\Models\Post;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;

/**
 * [FABRIC-METADATA]
 * Model: Post
 * Theme: Tailwind (Advanced)
 * Philosophy: Zero-Dependency Power Table
 */
class PostTable extends Component
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
    
        public $categories = [];

        public $showTrashed = false;


    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'id'],
        'sortDirection' => ['except' => 'desc'],
    ];

    public function mount()
    {
                $this->categories = \App\Models\Category::all();

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
        return Post::query()
                        ->when($this->filters['trash'] ?? null, function ($q, $trash) {
                if ($trash === 'with') $q->withTrashed();
                if ($trash === 'only') $q->onlyTrashed();
            })
            ->when($this->filters['category_id'] ?? null, fn($q, $val) => $q->where('category_id', $val))

            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->orWhere('title', 'like', "%{$this->search}%");
                    $q->orWhere('content', 'like', "%{$this->search}%");
                    $q->orWhere('meta_data', 'like', "%{$this->search}%");

                });
            })
            ->orderBy($this->sortField, $this->sortDirection);
    }

    public function render()
    {
        return view('livewire.fabric.app.models.post.table', [
            'rows' => $this->getRowsQuery()->paginate(10),
        ]);
    }

    
    public function restore($id)
    {
        $this->authorize('restore', Post::class);
        Post::withTrashed()->find($id)->restore();
        $this->dispatch('notify', message: __('Record restored successfully.'));
    }

    public function forceDelete($id)
    {
        $this->authorize('forceDelete', Post::class);
        Post::withTrashed()->find($id)->forceDelete();
        $this->dispatch('notify', message: __('Record permanently deleted.'));
    }

    public function deleteSelected()
    {
        // $this->authorize('deleteAny', Post::class);
        Post::whereIn('id', $this->selected)->delete();
        $this->selected = [];
        $this->dispatch('notify', message: __('Selected records deleted.'));
    }

    public function delete($id)
    {
        // $this->authorize('delete', Post::class);
        Post::find($id)->delete();
        $this->dispatch('notify', message: __('Record deleted successfully.'));
    }

    
}
