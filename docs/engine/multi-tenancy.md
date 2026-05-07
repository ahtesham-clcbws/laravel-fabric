# 🛡️ The Multi-Tenant Shield

Building SaaS applications requires strict data isolation. Fabric's **Tenant Shield** allows you to scaffold entire resources that are "Tenant-Aware" by default.

## 🚀 Activation
To forge a tenant-scoped resource, use the `--tenant` flag:

```bash
php artisan fabric:generate Project --tenant
```

## ⚙️ How it Works

### 1. Automatic Scoping
Fabric injects a global scope into the Livewire Table's query builder:
```php
$query->where('team_id', auth()->user()->team_id);
```

### 2. Hidden Injection
In the **Editor**, Fabric automatically injects a hidden field for the tenant key. This ensures that every new record created is automatically associated with the authenticated user's tenant.

### 3. Configuration
You can customize the tenant key in `config/fabric.php`:
```php
'tenant_key' => 'company_id', // Default is 'team_id'
```

## 🔒 Security
The Tenant Shield relies on Laravel's standard `auth()->user()` to retrieve the tenant ID. Ensure that your application has a robust authentication system (like the one provided by `fabric:auth`) and that your User model has the corresponding tenant key.
