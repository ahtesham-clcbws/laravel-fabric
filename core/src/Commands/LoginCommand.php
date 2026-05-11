<?php

declare(strict_types=1);

namespace CLCBWS\Fabric\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class LoginCommand extends Command
{
    protected $signature = 'fabric:login {--email=} {--token=}';
    protected $description = 'Authenticate your machine with the Fabric Global Registry';

    public function handle(): void
    {
        $this->components->info('🧬 Fabric Authentication: Global Identity');

        $email = $this->option('email') ?? $this->ask('Enter your developer email');
        $token = $this->option('token') ?? $this->secret('Enter your Fabric Access Token');

        $home = getenv('HOME') ?: getenv('USERPROFILE');
        $fabricDir = $home . DIRECTORY_SEPARATOR . '.fabric';
        $credentialsPath = $fabricDir . DIRECTORY_SEPARATOR . 'credentials.json';

        if (!File::isDirectory($fabricDir)) {
            File::makeDirectory($fabricDir, 0755, true);
        }

        $credentials = [
            'email' => $email,
            'token' => $token,
            'machine_id' => php_uname('n'),
            'last_login' => now()->toDateTimeString(),
        ];

        File::put($credentialsPath, json_encode($credentials, JSON_PRETTY_PRINT));

        $this->components->info('✨ Machine authenticated successfully!');
        $this->line("Identity saved to: <fg=gray>{$credentialsPath}</>");
    }
}
