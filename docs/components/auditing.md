# 🧬 Native Auditing (Zero-Dependency)

Fabric provides a built-in activity logging system that eliminates the need for external packages like `spatie/laravel-activitylog`. It is fast, lightweight, and 100% portable.

## 🚀 How to Use
To enable auditing on a model, simply use the `Auditable` trait forged by Fabric:

```php
use App\Traits\Auditable;

class Post extends Model
{
    use Auditable;
}
```

## 🛡️ What it Tracks
The engine automatically hooks into Eloquent lifecycle events:
- **Created**: Logs the initial state.
- **Updated**: Logs a precise **diff** of which columns changed, storing both old and new values.
- **Deleted**: Logs the final state before removal.

## 📊 Data Structure
All activities are stored in the `activities` table with the following metadata:
- `user_id`: The ID of the authenticated user who performed the action.
- `auditable_type/id`: Morphic relationship to the target model.
- `event`: The type of action (created, updated, deleted).
- `old_values/new_values`: JSON payloads of the changes.
- `ip_address/user_agent`: Metadata for security auditing.

## 🧪 Testing
The generated Pest tests for your resource include checks to verify that activities are being recorded correctly during CRUD operations.
