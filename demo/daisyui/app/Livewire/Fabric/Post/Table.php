<?php

namespace App\Livewire\Fabric\Post;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\Post;

/**
 * [FABRIC-METADATA]
 * Model: Post
 * Theme: Tailwind (Advanced)
 * Philosophy: Zero-Dependency Power Table
 */
#[Layout('layouts.fabric.sidebar')]
class Table extends Component
{
    use WithPagination;

    /**
     * 🧬 FORGED BY FABRIC
     * Handles state for searching, sorting, and filtering Post records.
     * Use wire:model.live on input fields to trigger real-time updates.
     */
    public $search = '';
    public $filters = [];
    public $perPage = 10;
    
    /**
     * 📊 Sorting Engine
     * 'sortField' determines the column, 'sortDirection' determines the order.
     */
    public $sortField = 'id';
    public $sortDirection = 'desc';

    // UI State
    public $columnVisibility = [];
    public $selected = [];
    public $selectAll = false;
    
        public $categories = [];

        public $showTrashed = false;

    
    protected $listeners = ['post-saved' => '$refresh'];

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'id'],
        'sortDirection' => ['except' => 'desc'],
        'perPage' => ['except' => 10],
    ];

    public function mount()
    {
                $this->categories = \App\Models\Category::all();

        
        // Initialize column visibility
        $this->columnVisibility = ['category_id' => true, 'title' => true, 'content' => true, 'is_published' => true, 'published_at' => true, 'meta_data' => true];

        if ($recordId = request('record')) {
             $this->dispatch('openModal', [
                 'component' => 'App\Livewire\Fabric\Post.PostEditor',
                 'arguments' => ['record' => $recordId]
             ]);
        }
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function sortBy(string $field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function toggleColumn(string $column)
    {
        $this->columnVisibility[$column] = !($this->columnVisibility[$column] ?? true);
    }

    public function updatedSelectAll(bool $value)
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
        return view('livewire.fabric.post.table', [
            'rows' => $this->getRowsQuery()->paginate($this->perPage),
        ]);
    }

    /**
     * 📥 ATOMIC CSV EXPORT
     * Forged by Fabric to provide high-performance data extraction without
     * requiring heavy external packages like Laravel-Excel.
     */
    public function exportToCsv()
    {
        $filename = "Post_" . now()->format('Y-m-d_His') . ".csv";
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['id', 'title', 'content', 'meta_data', 'created_at']; // Customizable
        
        $callback = function() use($columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, array_map('ucfirst', $columns));

            $this->getRowsQuery()->chunk(100, function($rows) use($file, $columns) {
                foreach ($rows as $row) {
                    $data = [];
                    foreach ($columns as $col) {
                        $data[] = $row->{$col};
                    }
                    fputcsv($file, $data);
                }
            });

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function deleteSelected()
    {
        Post::whereIn('id', $this->selected)->delete();
        $this->selected = [];
        $this->dispatch('notify', message: __('Selected records deleted.'));
    }

    public function delete(int|string $id)
    {
        Post::find($id)->delete();
        $this->dispatch('notify', message: __('Record deleted successfully.'));
    }
}
