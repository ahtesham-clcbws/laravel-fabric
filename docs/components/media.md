# 🖼️ Lean Media Handling

For projects that don't require the complex conversion engine of Spatie Media Library, Fabric forges a **Lean Media Handler**. It uses Laravel's native storage system for maximum speed and zero dependencies.

## 🚀 Usage
Apply the `HasFiles` trait to your model:

```php
use App\Traits\HasFiles;

class User extends Model
{
    use HasFiles;
}
```

## 📤 Uploading
In your Livewire components, you can call the `uploadFile` method:

```php
$this->record->uploadFile('avatar', $this->form['avatar']);
```

## 🖼️ Retrieving URLs
```php
$url = $user->getFileUrl('avatar');
```

## ✨ Features
- **Automatic Cleanup**: When you upload a new file to a column, the old file is automatically deleted from the disk to prevent storage bloat.
- **Dynamic Pathing**: Files are stored in `storage/app/public/uploads/{model-name}/` with randomized, collision-proof filenames.
- **Zero Configuration**: Works out-of-the-box with Laravel's `public` disk.
