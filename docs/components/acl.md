# 🛡️ Permissions ACL (Native Roles)

Fabric's **Permissions ACL** is a lightweight alternative to `spatie/laravel-permission`. It provides a clean, native way to handle authorization using Laravel's built-in Gates and Policies.

## 🚀 Setup
The engine scaffolds a `HasRoles` trait. Simply add it to your `User` model:

```php
use App\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
}
```

## 🔑 Usage

### Checking Roles
```php
if ($user->hasRole('admin')) {
    // Perform admin action
}

// Or check multiple roles
if ($user->hasRole(['editor', 'admin'])) {
    // ...
}
```

### Admin Helper
```php
if ($user->isAdmin()) {
    // ...
}
```

## 🔒 Policy Integration
When you forge a resource with Fabric, the generated Livewire components automatically include commented-out `$this->authorize()` calls. You can uncomment these to link the UI directly to your Laravel Policies.

```php
public function save()
{
    $this->authorize('update', $this->record);
    // ...
}
```

## 🛠️ Customization
The system uses a simple `role` column on your `users` table. You can extend the logic in the `HasRoles` trait to support more complex scenarios (like pivot tables) if your application grows.
