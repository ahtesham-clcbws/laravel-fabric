<?php

namespace CLCBWS\Fabric\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class StubForgeCommand extends Command
{
    protected $signature = 'fabric:stub {name}';
    protected $description = 'Forge a new master blueprint (stub) for custom component development';

    public function handle()
    {
        $name = $this->argument('name');
        $filename = "{$name}.php.stub";
        $path = \base_path("stubs/fabric/custom/{$filename}");

        if (File::exists($path)) {
            $this->error("Stub already exists: {$path}");
            return;
        }

        $stub = "<?php

namespace {{ NAMESPACE }};

use Livewire\Component;
use App\Models\{{ MODEL_NAME }};

/**
 * 🧬 CUSTOM FORGED COMPONENT
 * Forged by: Fabric Stub Forge
 */
class {{ MODEL_NAME }}{$name} extends Component
{
    public {{ MODEL_NAME }} \$record;

    public function mount({{ MODEL_NAME }} \$record)
    {
        \$this->record = \$record;
    }

    public function render()
    {
        return <<<'HTML'
            <div class=\"p-6\">
                <h1 class=\"text-2xl font-black uppercase tracking-tighter text-primary\">
                    {{ MODEL_NAME }} Details
                </h1>
                <!-- Forged Fields -->
                {{ FIELDS }}
            </div>
        HTML;
    }
}
";

        File::ensureDirectoryExists(dirname($path));
        File::put($path, $stub);

        $this->components->info("Blueprint Forged! Start designing at: {$path}");
    }
}
