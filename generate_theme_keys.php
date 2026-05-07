<?php

require __DIR__ . '/vendor/autoload.php';

use CLCBWS\Fabric\Engines\Guard;

$guard = new Guard();
$themes = ['tailwind', 'daisyui', 'floatui', 'hyperui', 'preline'];

foreach ($themes as $theme) {
    $path = __DIR__ . "/integration_test/" . $theme;
    $key = $guard->generateKey($path);
    echo "$theme: $key\n";
    
    // Update .env
    $envPath = $path . "/.env";
    if (file_exists($envPath)) {
        $content = file_get_contents($envPath);
        if (str_contains($content, 'FABRIC_LICENSE_KEY')) {
            $content = preg_replace('/FABRIC_LICENSE_KEY=.*/', "FABRIC_LICENSE_KEY=$key", $content);
        } else {
            $content .= "\nFABRIC_LICENSE_KEY=$key\n";
        }
        file_put_contents($envPath, $content);
    }
}
