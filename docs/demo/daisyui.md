# DaisyUI Demo: Professional Multi-Page Website

This demo showcases the full power of **Laravel Fabric** for building production-grade, dynamic websites and admin panels with zero friction, powered by the **DaisyUI** ecosystem.

## 🚀 Walkthrough: How we built this

Everything in this demo was generated using the Fabric CLI. No manual boilerplate was written.

### 1. The Foundation
We started by defining our models and migrations. Then we forged the admin panel resources:
```bash
# Forge CRUD for core resources using DaisyUI theme
php artisan fabric:generate Post --theme=daisyui
php artisan fabric:generate Category --theme=daisyui
php artisan fabric:generate Testimonial --theme=daisyui
php artisan fabric:generate Faq --theme=daisyui
php artisan fabric:generate Service --theme=daisyui
```

### 2. Dynamic Settings
We wanted the website's contact info and social links to be editable by the admin:
```bash
# Forge a Settings Editor
php artisan fabric:settings GeneralSettings --theme=daisyui
```

### 3. Component Extraction
To build the custom landing page, we extracted specific high-fidelity sections from the DaisyUI framework library:
```bash
# Extract pre-built UI components
php artisan fabric:component daisyui:hero
php artisan fabric:component daisyui:navbar-mega
php artisan fabric:component daisyui:testimonials
```

## 🛠️ Key Features in this Demo

- **Reactive CRUD**: All tables refresh in real-time when a modal is saved.
- **Bulk Actions**: Select multiple records and delete them with a single click.
- **Column Visibility**: Toggle table columns dynamically from the UI.
- **Dynamic Settings**: Website content (Site Name, Contact Info) is synced with a Spatie Settings class.
- **Spotlight Search**: Press `Ctrl+K` to search through all resources instantly.
- **Role Management**: Pre-configured `Admin` and `Editor` roles via Spatie Permissions.
- **Audit Trails**: Every action in the admin panel is logged automatically.
- **Premium Aesthetics**: Fully responsive DaisyUI theme with dark mode support.

## 📁 Directory Structure

- `app/Livewire/Fabric`: Forged Livewire components for the admin panel.
- `app/Settings`: Spatie settings classes.
- `resources/views/livewire/fabric`: Blade views for the forged components.
- `resources/views/components/fabric/daisyui`: Extracted UI components.
- `routes/fabric.php`: Automatic resource routing.

### 🚀 Summary
The DaisyUI demo serves as the primary reference for building high-fidelity interfaces with Fabric. It demonstrates the "Universal Manifesto" standards in a complete, production-ready environment.
