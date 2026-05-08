<?php

declare(strict_types=1);

namespace CLCBWS\Fabric\Commands;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

class VerifyCommand extends Command
{
    protected $signature = 'fabric:verify';
    protected $description = 'Perform a high-fidelity diagnostic check on the Fabric installation';

    public function handle()
    {
        $this->components->info("Verifying Laravel Fabric Integrity...");

        // 1. Check Routes
        $prefix = \config('fabric.prefix', 'admin');
        $loginRoute = route('login', [], false);
        
        if (Str::contains($loginRoute, $prefix)) {
            $this->components->twoColumnDetail("Route Integrity", '<fg=green>PASS</>');
        } else {
            $this->components->twoColumnDetail("Route Integrity", '<fg=red>FAIL (Check prefix config)</>');
        }

        // 2. Check Database
        try {
            \Illuminate\Support\Facades\DB::connection()->getPdo();
            $driver = \Illuminate\Support\Facades\DB::connection()->getDriverName();
            $status = ($driver === 'sqlite' && app()->environment('production')) ? '<fg=yellow>WARN (SQLite in Prod)</>' : '<fg=green>PASS ({$driver})</>';
            $this->components->twoColumnDetail("Database Connection", $status);
        } catch (\Exception $e) {
            $this->components->twoColumnDetail("Database Connection", '<fg=red>FAIL</>');
        }

        // 3. Check Mail Configuration
        $mailDriver = \config('mail.default');
        if (\in_array($mailDriver, ['smtp', 'mailgun', 'ses', 'postmark'])) {
            $this->components->twoColumnDetail("Mail Readiness", '<fg=green>PASS ({$mailDriver})</>');
        } else {
            $this->components->twoColumnDetail("Mail Readiness", '<fg=yellow>WARN ({$mailDriver} is not for Prod)</>');
        }

        // 4. Check SSL/HTTPS Enforcement
        $forceHttps = \config('app.force_https', false) || Str::startsWith(\config('app.url'), 'https://');
        $status = $forceHttps ? '<fg=green>PASS</>' : '<fg=yellow>WARN (HTTPS not forced)</>';
        $this->components->twoColumnDetail("SSL Enforcement", $status);

        $proxies = \config('trustedproxy.proxies');
        $proxyStatus = ($proxies === '*' || !empty($proxies)) ? '<fg=green>PASS</>' : '<fg=yellow>WARN (No Trusted Proxies)</>';
        $this->components->twoColumnDetail("Trusted Proxies", $proxyStatus);

        // 6. Check Encryption Key
        $key = \config('app.key');
        $cipher = \config('app.cipher');
        $requiredLength = ($cipher === 'AES-128-CBC') ? 16 : 32;
        
        if (Str::startsWith($key, 'base64:')) {
            $key = base64_decode(Str::after($key, 'base64:'));
        }

        $keyStatus = (strlen($key) === $requiredLength) ? '<fg=green>PASS ({$cipher})</>' : '<fg=red>FAIL (Invalid Key Length)</>';
        $this->components->twoColumnDetail("Encryption Key", $keyStatus);

        // 7. Check Assets
        if (File::exists(app_path('Livewire/Fabric/Dashboard.php'))) {
            $this->components->twoColumnDetail("Asset Availability", '<fg=green>PASS</>');
        } else {
            $this->components->twoColumnDetail("Asset Availability", '<fg=red>FAIL (Run fabric:assets)</>');
        }

        $this->newLine();
        $this->info("Verification Complete.");
    }
}
