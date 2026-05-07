# ⚗️ The Alchemist (Visual Transmutation)

The **Alchemist** is the "Secret Sauce" of Fabric. It allows you to grow your scaffolding library infinitely by transmuting any static HTML or Blade design into a dynamic Fabric stub.

## 🧪 Transmutation Process
The Alchemist performs a **Non-Destructive Replacement** of your design's static elements with Fabric placeholders:
1. **Color Injection**: Replaces hex/tailwind colors with `{{ PRIMARY }}`.
2. **Data Injection**: Replaces static text with `{{ MODEL_NAME }}` and `{{ FIELD_LABEL }}`.
3. **Logic Injection**: Weaves in the Livewire directives (`wire:model`, `wire:click`).

## 🚀 Usage
```bash
php artisan fabric:alchemy resources/views/my-cool-table.blade.php --name=PremiumTable
```
Once transmuted, your design becomes a permanent part of your Forge library.

---

# 🧟 The Lazarus Engine (Data Recovery)

Named after the biblical restoration, the **Lazarus Engine** manages the complete lifecycle of soft-deleted records.

## ♻️ The Lifecycle
If the Loom detects the `SoftDeletes` trait, it activates the Lazarus suite in the generated components:
- **The Trash Filter**: A tri-state UI component (Active / With Trash / Only Trash).
- **The Restore Action**: A policy-gated method to bring records back from the dead.
- **The Force Delete Action**: A secure method for permanent data destruction.

## 🔐 Authorization
Lazarus actions are strictly bound to the `restore` and `forceDelete` methods in your Laravel Policies.

---

# 🔨 The Fabricator (The Core Weaver)

The **Fabricator** is the orchestration engine that coordinates all other engines to produce the final artifacts.

## 🏗️ Path Resolution
The Fabricator is **Slim-Skeleton Aware**. It resolves target paths based on your model's namespace:
- `App\Models\User` -> `app/Livewire/Fabric/User/`
- `App\Models\Admin\Post` -> `app/Livewire/Fabric/Admin/Post/`

## 🔄 Directory Weaving
In minimal Laravel 12/13+ installations, many directories (like `app/Livewire` or `resources/views/layouts/fabric`) may not exist. The Fabricator **proactively weaves** these directories into existence with `0755` permissions during the forge process.
