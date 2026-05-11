# 🛠️ Testament I: Installation & Setup

Before you can forge your first resource, you must prepare your environment. Fabric is optimized for **PHP 8.3+** and **Laravel 13+**.

## 1. Requirement Checklist
Fabric requires the following to be present in your project:
- **Laravel 13.0+**
- **Livewire 4.x**
- **Tailwind CSS** (Vite or Standalone)
- **Alpine.js** (Standard with Livewire)

## 2. Composer Installation
Install the package via composer:

```bash
composer require clcbws/laravel-fabric --dev
```

## 3. Publishing the Config
The "Heart of the Forge" is the config file. Publish it to manage your themes and colors:

```bash
php artisan vendor:publish --tag=fabric-config
```

## 4. The Diagnostic Ritual (MANDATORY)
Before forging, run the **Doctor**. This is the automated path senior developers prefer to ensure your frontend dependencies and Tailwind configuration are 100% ready:

```bash
php artisan fabric:doctor
```

> [!IMPORTANT]
> **The Doctor's Orders**: If you are using **DaisyUI** or **Preline**, the Doctor will perform deep introspection of your `package.json` and provide the exact commands to resolve missing dependencies. **Do not ignore the Doctor.**

## 5. Setting Your Brand Colors
Open `config/fabric.php` and set your brand palette. These colors will be injected into every component Fabric generates.

```php
'palettes' => [
    'primary'   => env('FABRIC_COLOR_PRIMARY', 'indigo-600'),
    'secondary' => env('FABRIC_COLOR_SECONDARY', 'pink-600'),
],
```

---
[Next: The Loom Engine →](../engine/introspection.md)
