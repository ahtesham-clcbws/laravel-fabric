# 🛡️ The Dependency Jail (Native Purge)

Fabric's "Dependency Jail" is the ultimate tool for developers who want a lean, high-performance codebase. It identifies third-party packages that have been rendered obsolete by Fabric's native components.

## 🚀 How it Works
Run the command:
```bash
php artisan fabric:jail
```

The engine scans your `composer.json` and matches it against Fabric's "Replacement Registry."

## 📦 What it Detects:
| Third-Party Package | Fabric Native Replacement |
| :--- | :--- |
| `spatie/laravel-activitylog` | **Light-Audit (Auditable Trait)** |
| `maatwebsite/excel` | **Atomic CSV Export/Import** |
| `lab404/laravel-impersonate` | **Native Impersonation Engine** |
| `spatie/laravel-permission` | **Shield ACL (HasRoles Trait)** |
| `spatie/laravel-medialibrary` | **Lean-Media (HasFiles Trait)** |
| `spatie/laravel-health` | **Native Health Dashboard** |

## 🛡️ Safe Removal
The command doesn't just list them; it provides a **"Migration Path"** to help you move your existing data into Fabric's native tables before you run `composer remove`.
