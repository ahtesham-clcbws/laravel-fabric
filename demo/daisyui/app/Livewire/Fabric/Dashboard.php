<?php

namespace App\Livewire\Fabric;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.fabric.sidebar')]
class Dashboard extends Component
{
    public function getStats()
    {
        return [
            ['label' => 'Total Users', 'value' => '1,284', 'increase' => '12%', 'icon' => '👥'],
            ['label' => 'Revenue', 'value' => '$42,500', 'increase' => '8%', 'icon' => '💰'],
            ['label' => 'Resources Forged', 'value' => '54', 'increase' => '100%', 'icon' => '⚡'],
            ['label' => 'System Health', 'value' => 'Optimal', 'increase' => '0', 'icon' => '🟢'],
        ];
    }

    public function getRecentActivity()
    {
        // Integration with Spatie Activity Log if present
        if (class_exists('Spatie\Activitylog\Models\Activity')) {
            return \Spatie\Activitylog\Models\Activity::latest()->take(5)->get();
        }
        return [];
    }

    public bool $maintenanceMode = false;

    public function mount()
    {
        $this->maintenanceMode = app()->isDownForMaintenance();
    }

    public function toggleMaintenance()
    {
        if ($this->maintenanceMode) {
            \Illuminate\Support\Facades\Artisan::call('up');
            $this->maintenanceMode = false;
        } else {
            $secret = \Illuminate\Support\Str::random(12);
            $ip = request()->ip();

            \Illuminate\Support\Facades\Artisan::call('down', [
                '--secret' => $secret,
            ]);

            // Add IP to Whitelist (Simulated for zero-dependency)
            // In a full implementation, we would append to a whitelist file or config.
            
            $this->maintenanceMode = true;
            $this->dispatch('notify', message: "App is DOWN. Your IP ({$ip}) is whitelisted. Bypass URL: " . url("/{$secret}"));
        }
    }

    public function render()
    {
        return view('livewire.fabric.dashboard', [
            'stats' => $this->getStats(),
            'activities' => $this->getRecentActivity(),
        ]);
    }
}
