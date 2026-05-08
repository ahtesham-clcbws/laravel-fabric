# DaisyUI Demo: Professional Multi-Page Website

This demo showcases the full power of **Laravel Fabric** for building production-grade, dynamic websites and admin panels with zero friction.

## 🚀 Walkthrough: How we built this

Everything in this demo was generated using the Fabric CLI. No manual boilerplate was written.

### 1. The Foundation
We started by defining our models and migrations. Then we forged the admin panel:
```bash
# Forge CRUD for core resources
php artisan fabric:generate Post --force
php artisan fabric:generate Category --force
php artisan fabric:generate Testimonial --force
php artisan fabric:generate Faq --force
php artisan fabric:generate Service --force
php artisan fabric:generate Inquiry --force
```

### 2. Dynamic Settings
We wanted the website's contact info and social links to be editable by the admin:
```bash
# Forge a Settings Editor
php artisan fabric:settings GeneralSettings
```

### 3. The Website
Finally, we forged the 15-page frontend structure:
```bash
# Forge the 15-page website
php artisan fabric:site --theme=daisyui
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
- `resources/views/layouts/web.blade.php`: The dynamic website layout.
- `routes/fabric.php`: Automatic resource routing.
