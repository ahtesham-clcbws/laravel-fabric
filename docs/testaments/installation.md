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

## 4. The Diagnostic Ritual
Before forging, run the **Doctor** to ensure your frontend dependencies and Tailwind configuration are ready for your chosen theme:

```bash
php artisan fabric:doctor
```

> [!TIP]
> If you are using **DaisyUI** or **Preline**, the Doctor will tell you exactly which `npm` packages you are missing and provide the install commands.

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
