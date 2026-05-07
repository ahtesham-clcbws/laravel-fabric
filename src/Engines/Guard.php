<?php

namespace CLCBWS\Fabric\Engines;

use Illuminate\Support\Facades\Http;

class Guard
{
    /**
     * Verify if the current installation has a valid license.
     */
    public function verify(): bool
    {
        $key = \config('fabric.license_key') ?? \env('FABRIC_LICENSE_KEY');

        if (empty($key)) {
            return false;
        }

        // For now, we use a smart local checksum validation.
        // In the future, this can be swapped for a remote API call.
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

        // Project Fingerprint: A unique hash of the project's base path
        $fingerprint = \substr(\md5(\base_path()), 0, 8);
        $providedHash = $parts[1];

        // The key is valid if the first hash part matches the project fingerprint
        // This prevents sharing keys across different projects/folders.
        return \strtoupper($providedHash) === \strtoupper($fingerprint);
    }

    /**
     * Enforce the license check. Throws exception if invalid.
     */
    public function enforce()
    {
        if (!$this->verify()) {
            throw new \Exception("\n\n❌ [FABRIC LICENSE ERROR]\nCommercial or Enterprise usage detected without a valid license.\nPlease obtain a license at: https://clcbws.com/license\n\n");
        }
    }

    /**
     * Helper for the author to generate a valid key for a customer.
     * Usage: (new Guard)->generateKey('/path/to/customer/project')
     */
    public function generateKey(string $basePath): string
    {
        $fingerprint = \substr(\md5($basePath), 0, 8);
        $random = \strtoupper(\substr(\md5(\uniqid()), 0, 8));
        
        return "FAB-" . \strtoupper($fingerprint) . "-" . $random;
    }
}
