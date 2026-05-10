# 🛡️ Resource-Specific RBAC (Granular Security)

The Granular Security extension to our ACL system allows you to define per-resource permissions that are automatically enforced by the forged Fabric components.

## 🚀 How it Works
When you register a resource in the `SearchRegistry`, you can now define an optional `permissions` array:

```php
$registry->registerResource(User::class, 'fabric.users.index', '👤', [
    'permissions' => ['user:view', 'user:manage']
]);
```

## ✨ Features:
- **Auto-Enforcement**: The forged Table and Editor components will automatically check these permissions before allowing access.
- **Role Mapping**: Easily map these permissions to roles like "Editor," "Manager," or "Super Admin" via the `HasRoles` trait.
- **Zero-Dependency**: No need for `spatie/laravel-permission`—the logic is scaffolded as native Laravel Gates and Policies.

## 🛡️ Security
This ensures that even if an admin has access to the panel, they can only interact with the resources you've explicitly granted them access to.
