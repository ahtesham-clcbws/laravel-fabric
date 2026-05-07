<?php

namespace App\Livewire\Fabric;

use Livewire\Component;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Omnisearch extends Component
{
    public string $query = '';
    public array $results = [];

    public function updatedQuery(): void
    {
        if (strlen($this->query) < 2) {
            $this->results = [];
            return;
        }

        $this->results = $this->performSearch();
    }

    protected function performSearch(): array
    {
        $results = [];
        
        // This is where Fabric shines: It can search across all registered models
        // For the demo, we'll search for common admin tasks and registered models
        $models = [
            'Company' => ['route' => 'company.index', 'icon' => '📦'],
            'User' => ['route' => 'user.index', 'icon' => '👤'],
            'Setting' => ['route' => 'setting.index', 'icon' => '⚙️'],
        ];

        foreach ($models as $name => $data) {
            if (Str::contains(Str::lower($name), Str::lower($this->query))) {
                $results[] = [
                    'title' => "Manage {$name}s",
                    'description' => "Quick access to {$name} management",
                    'route' => $data['route'],
                    'icon' => $data['icon']
                ];
            }
        }

        return $results;
    }

    public function render()
    {
        return view('livewire.fabric.omnisearch');
    }
}
