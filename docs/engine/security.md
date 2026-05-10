# 🛡️ Guard & Jail: Enterprise Security

Laravel Fabric prioritizes security through two distinct yet integrated systems: **Guard** (Introspective Authorization) and **Jail** (Environment Isolation).

## The Guard Command

The `fabric:guard` command audits your models and controllers to ensure they follow secure-by-default patterns.

### Key Features
- **Policy Detection**: Verifies that every forged resource has a corresponding Laravel Policy.
- **Fillable Audit**: Scans for `guarded` vs `fillable` inconsistencies that could lead to mass assignment vulnerabilities.
- **Middleware Enforcement**: Ensures all Fabric routes are protected by the `auth` and `web` middleware stacks.

## The Jail Engine

**Jail** is Fabric's approach to environment safety and data anonymization. It prevents sensitive production data from leaking into development or staging environments.

### Features
- **Data Masking**: Automatically replaces PII (Personally Identifiable Information) with faked data during cloning or synchronization.
- **Environment Securitying**: Prevents accidental execution of destructive commands (like `db:wipe`) in production environments.
- **Integrity Checks**: Validates that all cross-table foreign keys are consistent before any data manipulation.

## Authorization Patterns

Fabric uses a "Permission-Aware" generation strategy:

```php
// Generated logic automatically includes authorization checks
public function delete($id)
{
    if (config('fabric.ecosystem.permission')) {
        $this->authorize('delete', $record);
    }
    
    $record->delete();
}
```

### Integration with Spatie
If `spatie/laravel-permission` is detected, Fabric can automatically generate roles and permissions for every new resource created.

---

> [!IMPORTANT]
> Always run `php artisan fabric:guard` before deploying to production to ensure your security posture is intact.
