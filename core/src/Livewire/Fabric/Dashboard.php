<?php
namespace CLCBWS\Fabric\Livewire\Fabric;
use Livewire\Component;
class Dashboard extends Component {
    public function render() {
        return view('vendor.fabric.fabric.dashboard')->layout('vendor.fabric.layouts.admin');
    }
}
