<?php

namespace CLCBWS\Fabric\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ImportCommand extends Command
{
    protected $signature = 'fabric:import {model} {file}';
    protected $description = 'Perform a high-performance CSV import into a model natively';

    public function handle()
    {
        $model = $this->argument('model');
        $file = $this->argument('file');
        $modelClass = "App\\Models\\{$model}";

        if (!class_exists($modelClass)) {
            $this->error("Model {$modelClass} not found.");
            return;
        }

        if (!File::exists($file)) {
            $this->error("File {$file} not found.");
            return;
        }

        $this->components->info("Starting Native Import for: {$modelClass}");

        $handle = fopen($file, 'r');
        $header = fgetcsv($handle);
        $count = 0;

        while (($data = fgetcsv($handle)) !== false) {
            $row = array_combine($header, $data);
            $modelClass::create($row);
            $count++;
        }

        fclose($handle);

        $this->info("✨ Successfully imported {$count} records into {$model}.");
    }
}
