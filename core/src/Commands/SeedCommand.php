<?php

declare(strict_types=1);

namespace CLCBWS\Fabric\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;

class SeedCommand extends Command
{
    protected $signature = 'fabric:seed {--admin=admin@example.com} {--password=password} {--roles}';
    protected $description = 'Forge essential data: Admin user, roles, and initial content';

    public function handle(): void
    {
        $this->components->info("Fabric Seeder: Forging the Foundation");

        if ($this->option('roles')) {
            $this->seedRoles();
        }

        $this->seedAdmin();

        $this->info("✨ Seeding successful. You can now login with: " . $this->option('admin'));
    }

    protected function seedRoles(): void
    {
        $this->components->task("Forging Roles (Admin, Editor)", function() {
            Role::firstOrCreate(['name' => 'admin']);
            Role::firstOrCreate(['name' => 'editor']);
        });
    }

    protected function seedAdmin(): void
    {
        $email = $this->option('admin');
        $password = $this->option('password');

        $this->components->task("Creating Admin User: {$email}", function() use ($email, $password) {
            $admin = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => 'Fabric Admin',
                    'password' => Hash::make($password),
                    'email_verified_at' => now(),
                ]
            );

            if (class_exists(Role::class)) {
                $admin->assignRole('admin');
            }
        });
    }
}
