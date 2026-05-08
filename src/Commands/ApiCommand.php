<?php

declare(strict_types=1);

namespace CLCBWS\Fabric\Commands;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use CLCBWS\Fabric\Engines\Loom;
use Illuminate\Console\Command;

class ApiCommand extends Command
{
    protected $signature = 'fabric:api {model} {--force}';
    protected $description = 'Forge a high-fidelity REST API (Resource, Controller) for a model';

    public function handle(Loom $loom)
    {
        $model = $this->argument('model');
        $modelClass = "App\\Models\\{$model}";
        
        if (!class_exists($modelClass)) {
            $this->error("Model {$modelClass} not found.");
            return;
        }

        $this->components->info("Forging API for: {$modelClass}");

        $contract = $loom->introspect($modelClass);
        $modelName = class_basename($modelClass);

        $this->generateResource($modelName, $contract);
        $this->generateController($modelName, $contract);

        $this->newLine();
        
        if (!File::exists(base_path('routes/api.php'))) {
            $this->components->warn("API routes are not installed. Run 'php artisan install:api' first.");
        }

        $this->info("API Forge complete. Register the route in routes/api.php:");
        $this->line("Route::apiResource('" . Str::kebab(Str::plural($modelName)) . "', \\App\\Http\\Controllers\\Api\\{$modelName}ApiController::class);");
    }

    protected function generateResource(string $name, array $contract): void
    {
        $path = app_path("Http/Resources/{$name}Resource.php");
        File::ensureDirectoryExists(dirname($path));

        $fields = "";
        foreach ($contract['fields'] as $fieldName => $data) {
            $fields .= "            '{$fieldName}' => \$this->{$fieldName},\n";
        }

        $stub = "<?php


namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class {$name}Resource extends JsonResource
{
    public function toArray(Request \$request): array
    {
        return [
{$fields}
        ];
    }
}";

        File::put($path, $stub);
        $this->components->twoColumnDetail("Resource: {$name}Resource", '<fg=green>Created</>');
    }

    protected function generateController(string $name, array $contract): void
    {
        $path = app_path("Http/Controllers/Api/{$name}ApiController.php");
        File::ensureDirectoryExists(dirname($path));

        $searchCol = collect($contract['fields'])->keys()->first(fn($f) => in_array($f, ['name', 'title', 'email', 'subject'])) ?? 'id';

        $stub = "<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\\{$name};
use App\Http\Resources\\{$name}Resource;
use Illuminate\Http\Request;

class {$name}ApiController extends Controller
{
    public function index(Request \$request)
    {
        \$query = {$name}::query();

        if (\$request->has('search')) {
            \$query->where('{$searchCol}', 'like', '%' . \$request->search . '%');
        }

        return {$name}Resource::collection(\$query->paginate());
    }

    public function store(Request \$request)
    {
        \$data = \$request->validate([
            // TODO: Use Fabric validation rules here
        ]);

        \$record = {$name}::create(\$data);
        return new {$name}Resource(\$record);
    }

    public function show({$name} \$record)
    {
        return new {$name}Resource(\$record);
    }

    public function update(Request \$request, {$name} \$record)
    {
        \$record->update(\$request->all());
        return new {$name}Resource(\$record);
    }

    public function destroy({$name} \$record)
    {
        \$record->delete();
        return response()->noContent();
    }
}";

        File::put($path, $stub);
        $this->components->twoColumnDetail("Controller: {$name}ApiController", '<fg=green>Created</>');
    }
}
