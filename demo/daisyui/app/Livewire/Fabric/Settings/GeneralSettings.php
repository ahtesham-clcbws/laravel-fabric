<?php

namespace App\Livewire\Fabric\Settings;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Settings\GeneralSettings as SettingsModel;

#[Layout('layouts.fabric.sidebar')]
class GeneralSettings extends Component
{
    /**
     * 🧬 FORGED BY FABRIC
     * Handles state for GeneralSettings.
     */
    public array $state = [];

    public function mount(SettingsModel $settings)
    {
        $this->state = $settings->toArray();
    }

    public function save(SettingsModel $settings)
    {
        $settings->fill($this->state);
        $settings->save();

        $this->dispatch('notify', message: __('Settings saved successfully.'));
    }

    public function render()
    {
        return view('livewire.fabric.settings.general-settings.settings');
    }
}
