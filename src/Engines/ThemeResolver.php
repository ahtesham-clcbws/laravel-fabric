<?php

namespace CLCBWS\Fabric\Engines;

use Illuminate\Support\Facades\File;

class ThemeResolver
{
    /**
     * Resolve the absolute path to the active theme stubs.
     */
    public function resolvePath(string $theme, string $runtime): string
    {
        // 1. Check for user-published stubs in base_path('stubs/fabric/...')
        $userPath = base_path("stubs/fabric/{$runtime}/{$theme}");
        if (File::isDirectory($userPath)) {
            return $userPath;
        }

        // 2. Check for package stubs
        $packagePath = __DIR__ . "/../../stubs/{$runtime}/{$theme}";
        if (File::isDirectory($packagePath)) {
            return $packagePath;
        }

        // 3. Fallback to default tailwind theme if requested theme doesn't exist
        return __DIR__ . "/../../stubs/{$runtime}/tailwind";
    }

    /**
     * Get all available stubs in the resolved path.
     */
    public function getStubs(string $path): array
    {
        return File::files($path);
    }
}
