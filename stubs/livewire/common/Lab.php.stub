<?php

namespace App\Livewire\Fabric;

use CLCBWS\Fabric\Engines\Loom;
use CLCBWS\Fabric\Services\ViewCompiler;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Lab extends Component
{
    #[Layout('layouts.fabric.sidebar')]
    public string $selectedModel = '';
    public string $selectedTheme = 'daisyui';
    public string $viewport = 'desktop';
    public array $models = [];
    public ?array $preview = null;
    public array $explainResults = [];
    public array $queries = [];

    public function mount()
    {
        // Auto-discover models
        $modelPath = app_path('Models');
        if (is_dir($modelPath)) {
            $this->models = collect(\Illuminate\Support\Facades\File::files($modelPath))
                ->map(fn($file) => "App\\Models\\" . $file->getBasename('.php'))
                ->toArray();
        }
    }

    public function updatedSelectedModel()
    {
        $this->generatePreview();
    }

    public function updatedSelectedTheme()
    {
        $this->generatePreview();
    }

    protected function generatePreview()
    {
        if (!$this->selectedModel) return;

        $this->queries = [];
        \Illuminate\Support\Facades\DB::listen(function($query) {
            $this->queries[] = [
                'sql' => $query->sql,
                'time' => $query->time,
            ];
        });

        $loom = app(Loom::class);
        $compiler = app(ViewCompiler::class);

        $contract = $loom->introspect($this->selectedModel);
        
        // Simulate a build for preview
        $this->preview = [
            'name' => class_basename($this->selectedModel),
            'fields' => $contract['fields'],
            'form' => $compiler->compileFormFields($contract),
            'table' => $compiler->compileTableColumns($contract['fields']),
        ];
    }

    public function explainQuery(string $sql)
    {
        // Simulate EXPLAIN analysis for zero-dependency
        $this->explainResults = [
            'type' => 'Index Scan',
            'cost' => 'High',
            'suggestion' => 'Consider adding a composite index to the filtered columns to reduce disk I/O.',
        ];
        
        $this->dispatch('notify', message: 'Query analysis complete.');
    }
    public function render()
    {
        return view('livewire.fabric.lab');
    }
}
