<?php

$modelClass = 'App\Models\Category';
$normalizedClass = \str_replace('/', '\\', $modelClass);
$normalizedDir = \str_replace('/', '\\', \dirname(\str_replace('\\', '/', $normalizedClass)));
$subNamespace = \str_replace(['App\\Models\\', 'App\\Models', 'App\\'], '', $normalizedDir);

echo "Model: $modelClass\n";
echo "Dir: $normalizedDir\n";
echo "Sub: $subNamespace\n";
