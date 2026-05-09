<?php

namespace CLCBWS\Fabric\Livewire\Components;

use Livewire\Component;

class Chart extends Component
{
    public string $type = 'line';
    public string $height = '300px';
    public array $series = [];
    public array $options = [];
    public string $chartId;

    public function mount(string $type = 'line', array $series = [], array $options = [], string $height = '300px')
    {
        $this->type = $type;
        $this->series = $series;
        $this->options = $options;
        $this->height = $height;
        $this->chartId = 'chart-' . uniqid();
    }

    public function render()
    {
        return view('fabric::livewire.components.chart');
    }
}
