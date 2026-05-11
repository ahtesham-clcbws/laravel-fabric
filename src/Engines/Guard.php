<?php

declare(strict_types=1);

namespace CLCBWS\Fabric\Engines;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Http;

readonly class Guard
{
    /**
     * Verify if the current installation has a valid license.
     */
    public function verify(): bool
    {
        if (app()->isLocal() || app()->runningUnitTests()) {
            return true;
        }

        $key = \config('fabric.license_key');

        if (empty($key)) {
            return false;
        }

        return $this->validateChecksum($key);
    }

    /**
     * A project-bound checksum logic.
     * Format: FAB-{PROJECT_HASH}-{LICENSE_HASH}
     */
    protected function validateChecksum(string $key): bool
    {
        if (!\str_starts_with($key, 'FAB-')) {
            return false;
        }

        $parts = \explode('-', $key);
        if (\count($parts) < 3) {
            return false;
        }

        $fingerprint = $this->getProjectFingerprint();
        $providedHash = $parts[1];

        return \strtoupper($providedHash) === \strtoupper($fingerprint);
    }

    /**
     * Get or generate a project-stable fingerprint.
     */
    protected function getProjectFingerprint(): string
    {
        $path = \base_path('.fabric');
        
        if (File::exists($path)) {
            $uuid = \trim(File::get($path));
        } else {
            $uuid = Str::random(32);
            File::put($path, $uuid);
            
            // Proactively hide the identity from git
            $gitignore = \base_path('.gitignore');
            if (File::exists($gitignore)) {
                $content = File::get($gitignore);
                if (!\str_contains($content, '.fabric')) {
                    File::append($gitignore, "\n# Fabric Identity\n.fabric\n");
                }
            }
        }

        return \substr(\md5($uuid), 0, 8);
    }

    /**
     * Enforce the license check. Throws exception if invalid.
     */
    public function enforce(): void
    {
        if (!$this->verify()) {
            throw new \Exception("\n\n❌ [FABRIC LICENSE ERROR]\nCommercial or Enterprise usage detected without a valid license.\nPlease obtain a license at: https://clcbws.com/license\n\n");
        }
    }

    /**
     * Helper for the author to generate a valid key for a customer.
     */
    public function generateKey(string $uuid): string
    {
        $fingerprint = \substr(\md5($uuid), 0, 8);
        $random = \strtoupper(\substr(\md5(\uniqid()), 0, 8));
        
        return "FAB-" . \strtoupper($fingerprint) . "-" . $random;
    }
}
