<?php

namespace CLCBWS\Fabric\Livewire\Components;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use CLCBWS\Fabric\Services\SearchRegistry;

class Spotlight extends Component
{
    public $search = '';
    public $isOpen = false;
    public $results = [];

    protected $listeners = ['toggleSpotlight' => 'toggle'];

    public function toggle()
    {
        $this->isOpen = !$this->isOpen;
        if ($this->isOpen) {
            $this->search = '';
            $this->results = [];
        }
    }

    public function updatedSearch()
    {
        if (strlen($this->search) < 2) {
            $this->results = collect();
            return;
        }

        $this->results = app(SearchRegistry::class)->search($this->search);
    }

    public function render()
    {
        return view('fabric::livewire.spotlight');
    }
}
