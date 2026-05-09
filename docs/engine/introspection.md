# 🧶 The Loom (Introspection Engine)

The **Loom** is the cerebral cortex of Fabric. It is responsible for analyzing your Eloquent models and database schema to build a **UI Data Contract**.

## 🧠 How it Works

When you run `php artisan fabric:generate`, the Loom:
1. **Introspects the Model**: Reflects on the Eloquent class to find traits (like `SoftDeletes` or `HasApiTokens`).
2. **Scans the Schema**: Uses the database driver to identify column types, nullability, and default values.
3. **Weaves Relationships**: Queries the database's foreign key constraints to identify `BelongsTo`, `HasMany`, and `ManyToMany` associations.

## ⚡ Schema Caching
To ensure zero-lag in large enterprise databases, the Loom implements a static **Schema Cache**. This avoids redundant full-table scans during a multi-resource forge.

## 🔗 Supported Relationships
- **BelongsTo**: Automatically forged as a Searchable Select or Radio group.
- **HasMany**: Forged as a nested, high-fidelity table in the "Show" view.
- **ManyToMany**: Forged as a multi-select relationship with automatic pivot table synchronization.

---

# 🛡️ The Guard (Security Engine)

The **Guard** ensures that your application remains secure and your intellectual property is protected.

## 🔑 Project-Bound Licensing
Fabric uses a proprietary fingerprinting algorithm to bind your license key to your specific project path. 
- **Fingerprint**: `sha256(base_path())`.
- **Validation**: License keys are validated against this fingerprint to prevent unauthorized distribution.

## 🔐 Automatic Authorization
Every generated component includes strict authorization gates:
```php
$this->authorize('viewAny', User::class);
```
The Guard automatically detects your **Laravel Policies** and wires them into the generated Livewire actions. If no policy exists, the Doctor will alert you during the diagnostic phase.
