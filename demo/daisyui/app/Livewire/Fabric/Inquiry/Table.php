<?php

namespace App\Livewire\Fabric\Inquiry;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\Inquiry;

/**
 * [FABRIC-METADATA]
 * Model: Inquiry
 * Theme: Tailwind (Advanced)
 * Philosophy: Zero-Dependency Power Table
 */
#[Layout('layouts.fabric.sidebar')]
class Table extends Component
{
    use WithPagination;

    /**
     * 🧬 FORGED BY FABRIC
     * Handles state for searching, sorting, and filtering Inquiry records.
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
    
    
    
    
    protected $listeners = ['inquiry-saved' => '$refresh'];

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'id'],
        'sortDirection' => ['except' => 'desc'],
        'perPage' => ['except' => 10],
    ];

    public function mount()
    {
        
        
        // Initialize column visibility
        $this->columnVisibility = ['' => true];

        if ($recordId = request('record')) {
             $this->dispatch('openModal', [
                 'component' => 'App\Livewire\Fabric\Inquiry.InquiryEditor',
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
        return Inquiry::query()
            
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->orWhere('name', 'like', "%{$this->search}%");
                    $q->orWhere('email', 'like', "%{$this->search}%");
                    $q->orWhere('subject', 'like', "%{$this->search}%");
                    $q->orWhere('message', 'like', "%{$this->search}%");

                });
            })
            ->orderBy($this->sortField, $this->sortDirection);
    }

    public function render()
    {
        return view('livewire.fabric.inquiry.table', [
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
        $filename = "Inquiry_" . now()->format('Y-m-d_His') . ".csv";
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['id', 'name', 'email', 'subject', 'message', 'created_at']; // Customizable
        
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
        Inquiry::whereIn('id', $this->selected)->delete();
        $this->selected = [];
        $this->dispatch('notify', message: __('Selected records deleted.'));
    }

    public function delete(int|string $id)
    {
        Inquiry::find($id)->delete();
        $this->dispatch('notify', message: __('Record deleted successfully.'));
    }
}
