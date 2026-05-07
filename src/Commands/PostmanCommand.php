<?php

namespace CLCBWS\Fabric\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PostmanCommand extends Command
{
    protected $signature = 'fabric:postman';
    protected $description = 'Forge a high-fidelity Postman Collection for all your Fabric API endpoints';

    public function handle()
    {
        $this->components->info("Forging Postman Collection: Mapping API Endpoints...");

        $collection = [
            'info' => [
                'name' => config('app.name') . ' API (Fabric Forged)',
                'schema' => 'https://schema.getpostman.com/json/collection/v2.1.0/collection.json',
            ],
            'item' => [],
        ];

        // Scan Api Controllers
        $controllers = File::files(app_path('Http/Controllers/Api'));
        
        foreach ($controllers as $file) {
            $name = $file->getFilenameWithoutExtension();
            $resource = Str::replace('ApiController', '', $name);
            $slug = Str::kebab(Str::plural($resource));

            $collection['item'][] = [
                'name' => $resource,
                'item' => $this->generateEndpoints($slug),
            ];
        }

        File::put(base_path('postman_collection.json'), \json_encode($collection, JSON_PRETTY_PRINT));
        $this->info("✨ Postman Collection forged! Import postman_collection.json into Postman.");
    }

    protected function generateEndpoints(string $slug): array
    {
        $endpoints = [
            ['name' => 'List All', 'method' => 'GET', 'path' => $slug],
            ['name' => 'Create New', 'method' => 'POST', 'path' => $slug],
            ['name' => 'Get Single', 'method' => 'GET', 'path' => "{$slug}/1"],
            ['name' => 'Update Record', 'method' => 'PUT', 'path' => "{$slug}/1"],
            ['name' => 'Delete Record', 'method' => 'DELETE', 'path' => "{$slug}/1"],
        ];

        return collect($endpoints)->map(fn($e) => [
            'name' => $e['name'],
            'request' => [
                'method' => $e['method'],
                'url' => [
                    'raw' => "{{base_url}}/api/{$e['path']}",
                    'host' => ["{{base_url}}"],
                    'path' => ["api", $e['path']],
                ],
            ],
        ])->toArray();
    }
}
