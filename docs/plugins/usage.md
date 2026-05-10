# 📖 Native Plugin Usage Guide

This guide provides the technical implementation details for every Fabric Native Plugin. Learn how to activate these "Ghost" features in your Eloquent models and CLI.

---

## 🛡️ Security & Permissions
### RBAC (Permissions)
To activate Role-Based Access Control, add the `HasRoles` trait to your User model.

```php
use App\Traits\Permissions\HasRoles;

class User extends Authenticatable {
    use HasRoles;
}
```
**Usage in Blade:**
```blade
@can('user:manage')
    <button>Edit User</button>
@endcan
```

---

## 🧬 Dynasty (STI)
To implement Single Table Inheritance, add the `HasParent` trait to your child models.

```php
use App\Traits\Dynasty\HasParent;

class Admin extends User {
    use HasParent;
}
```
Fabric will automatically scope queries for `Admin::all()` to only return records with `type = Admin::class`.

---

## 🔗 Sluggable Models
To automate slug generation, add the `HasSlug` trait.

```php
use App\Traits\Sluggable\HasSlug;

class Post extends Model {
    use HasSlug;

    protected function slugSource(): string {
        return 'title'; // Source field for the slug
    }
}
```

---

## 🆔 Identity (Unique IDs)
To use ULIDs instead of sequential integers, add the `HasUniqueIds` trait.

```php
use App\Traits\Identity\HasUniqueIds;

class Order extends Model {
    use HasUniqueIds;
}
```

---

## 🌍 Polyglot (Enum Translation)
To translate Enum labels, add the `TranslatableEnum` trait to your PHP Enum.

```php
use App\Traits\Polyglot\TranslatableEnum;

enum Status: string {
    use TranslatableEnum;
    case PENDING = 'pending';
}

// In your view:
{{ Status::PENDING->label() }}
```
*Note: Create translation keys in `lang/en/enums.php`.*

---

## 🧠 Cortex (Smart Cache)
To enable automatic relational caching, add the `Cacheable` trait.

```php
use App\Traits\Cortex\Cacheable;

class Product extends Model {
    use Cacheable;
}

// Retrieve from cache
Product::cachedFind($id);
```

---

## ⚡ Hydrate & Snapshot
### Seeding with Hydrate
Populate your database with raw SQL speed:
```bash
php artisan fabric:hydrate ModelName --count=1000
```

### Capturing with Snapshot
Capture existing data into a portable stub:
```bash
php artisan fabric:snapshot table_name
```

---

## 📊 Analytics & Vacuum
### Project Analytics
Measure your code volume and Forge ROI:
```bash
php artisan fabric:analytics
```

### Vendor Vacuum
Slim down your project by purging non-essential vendor files:
```bash
php artisan fabric:vacuum
```

---

## 🔦 Postman & OmniDoc
### Generate Postman Collection
```bash
php artisan fabric:postman
```

### Generate Swagger/OpenAPI
```bash
php artisan fabric:api --docs
```
View your documentation at `/admin/fabric/docs`.
