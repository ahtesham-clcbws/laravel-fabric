<?php

declare(strict_types=1);

namespace CLCBWS\Fabric\Engines;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Http;

readonly class Guard
{
    /**
     * The Master Public Key for license verification.
     */
    private string $publicKey = "-----BEGIN PUBLIC KEY-----\nMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA70gUKT1VONMTK0kzvBdJ\nYfzBpF7VCXs6Ogg7ABKkjRn4SQvwrkAaXlUlToIhN1ezwSdG0Qk3mWExu8aXeNB1\nzK0TSQ3jpvfKD/4AfJq8i38JKz9agCiDMcR43mbW+vT3+bQzEzNcMMJzCY48DPBp\nNpZpAvtiBKl8SQ+zx0zC0OTbqUAN/M9S0FCzFsGzL6A7NNe2NpI7X58bMklIQbRJ\ngMUNN1/3EQ+DssMBVT92SYgB8PLZTlGTaLMjYxO+oYd30qsQXaIMUJlsJeAeX8DX\nGtmGmxUkfr8Qrlom2xOV/KV1Z5uOQEBgUA9Bbk3TQFFaSZ5atj8q2ilUUm0BBzSs\n6wIDAQAB\n-----END PUBLIC KEY-----";

    /**
     * Verify if the current installation has a valid license.
     */
    public function verify(): bool
    {
        // 🛡️ PHAR Enforcement
        if (!$this->isPharEnforced()) {
            return false;
        }

        if (app()->isLocal() || app()->runningUnitTests()) {
            return true;
        }

        $licensePath = \base_path('.fabric_license');
        if (!File::exists($licensePath)) {
            return false;
        }

        return $this->verifySignature(File::get($licensePath));
    }

    /**
     * Ensure the engine is running from a protected PHAR in production.
     */
    protected function isPharEnforced(): bool
    {
        if (app()->isLocal() || app()->runningUnitTests()) {
            return true;
        }

        return \str_starts_with(__FILE__, 'phar://');
    }

    /**
     * Verify the RSA-2048 signature of the project license.
     */
    protected function verifySignature(string $data): bool
    {
        $uuidPath = \base_path('.fabric');
        if (!File::exists($uuidPath)) return false;

        $uuid = \trim(File::get($uuidPath));
        $signature = \base64_decode($data);
        
        return \openssl_verify($uuid, $signature, $this->publicKey, OPENSSL_ALGO_SHA256) === 1;
    }

    /**
     * Enforce the license check. Throws exception if invalid.
     */
    public function enforce(): void
    {
        if (!$this->verify()) {
            throw new \Exception("\n\n❌ [FABRIC LICENSE ERROR]\nCommercial usage detected without a valid license.\nPlease register this project: php artisan fabric:register\n\n");
        }
    }
}
