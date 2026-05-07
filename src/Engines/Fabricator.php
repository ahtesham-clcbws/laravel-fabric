<?php

namespace CLCBWS\Fabric\Engines;

use CLCBWS\Fabric\Contracts\FabricatorContract;
use CLCBWS\Fabric\Services\ViewCompiler;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

readonly class Fabricator implements FabricatorContract
{
    protected Loom $loom;
    protected ThemeResolver $themeResolver;
    protected ViewCompiler $viewCompiler;
    protected Guard $guard;

    public function __construct(Loom $loom, ThemeResolver $themeResolver, ViewCompiler $viewCompiler, Guard $guard)
    {
        $this->loom = $loom;
        $this->themeResolver = $themeResolver;
        $this->viewCompiler = $viewCompiler;
        $this->guard = $guard;
    }

    /**
     * Build the entire resource for a given model.
     */
    public function build(string $modelClass, array $options = []): array
    {
        $this->guard->enforce();

        $dataContract = $this->loom->introspect($modelClass);
        $theme = $options['theme'] ?? \config('fabric.theme', 'tailwind');
        $runtime = $options['runtime'] ?? \config('fabric.runtime', 'livewire');

        $stubPath = $this->themeResolver->resolvePath($theme, $runtime);
        $stubs = $this->themeResolver->getStubs($stubPath);

        $generatedFiles = [];

        foreach ($stubs as $stub) {
            $generatedFiles[] = $this->forgeFile($stub, $dataContract);
        }

        // Generate Pest Test
        $testStub = new \SplFileInfo(__DIR__ . '/../../stubs/livewire/common/PestTest.php.stub');
        if (File::exists($testStub->getPathname())) {
            $generatedFiles[] = $this->forgeFile($testStub, $dataContract);
        }

        return $generatedFiles;
    }

    /**
     * Compile a specific stub and write it to the target location.
     */
    protected function forgeFile(\SplFileInfo $stub, array $data): string
    {
        $content = File::get($stub->getPathname());
        $compiled = $this->viewCompiler->compile($content, $data);
        
        // Handle PHP-specific hooks for Livewire classes
        if (Str::endsWith($stub->getFilename(), '.php.stub')) {
            $compiled = str_replace(
                [
                    '// [FABRIC-RELATIONSHIP-PROPERTIES]',
                    '// [FABRIC-RELATIONSHIP-FETCH]',
                ],
                [
                    $this->viewCompiler->compileRelationshipProperties($data['relationships'] ?? []),
                    $this->viewCompiler->compileRelationshipFetching($data['relationships'] ?? []),
                ],
                $compiled
            );
        }
        
        $targetPath = $this->resolveTargetPath($stub, $data);
        
        // Proactive directory weaving for Slim Skeletons
        $directory = \dirname($targetPath);
        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        File::put($targetPath, $compiled);

        return $targetPath;
    }

    /**
     * Resolve where the generated file should be saved.
     */
    protected function resolveTargetPath(\SplFileInfo $stub, array $data): string
    {
        $fullModelClass = $data['model'];
        $modelName = \class_basename($fullModelClass);
        
        // Extract sub-namespace relative to App\Models
        $subNamespace = \str_replace(['App\\Models\\', 'App\\'], '', \dirname(\str_replace('\\', '/', $fullModelClass)));
        $subNamespace = \str_replace('/', DIRECTORY_SEPARATOR, $subNamespace);
        $subNamespace = \trim($subNamespace, DIRECTORY_SEPARATOR);
        
        $targetDirName = !empty($subNamespace) ? $subNamespace . DIRECTORY_SEPARATOR . $modelName : $modelName;

        $filename = \str_replace(['stub', 'MODEL_NAME'], ['', $modelName], $stub->getFilename());
        $filename = \trim($filename, '.');

        // Handle Test Generation
        if ($filename === 'PestTest.php') {
            return \base_path("tests/Feature/Fabric/{$targetDirName}Test.php");
        }

        if (Str::endsWith($filename, '.php') && !Str::endsWith($filename, '.blade.php')) {
            $path = \config('fabric.output.livewire');
            $fullPath = Str::startsWith($path, DIRECTORY_SEPARATOR) || Str::contains($path, ':') ? $path : \base_path($path);
            return $fullPath . DIRECTORY_SEPARATOR . $targetDirName . DIRECTORY_SEPARATOR . $filename;
        }

        $viewPath = \resource_path('views/' . \str_replace('.', '/', $this->viewCompiler->getViewPath($data)));
        return "{$viewPath}/{$filename}";
    }
}
