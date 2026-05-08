# 🛡️ Laravel Fabric: Application Context

## 🧬 Data Architecture

### Model: Category
- **Namespace**: App\Models\Category
- **Fields**: name, description
- **Traits**: Illuminate\Database\Eloquent\Factories\HasFactory

### Model: Post
- **Namespace**: App\Models\Post
- **Fields**: category_id, title, content, is_published, published_at, meta_data
- **Traits**: Illuminate\Database\Eloquent\Factories\HasFactory, Illuminate\Database\Eloquent\SoftDeletes
- **Relationships**: category_id

### Model: Tag
- **Namespace**: App\Models\Tag
- **Fields**: name, slug
- **Traits**: Illuminate\Database\Eloquent\Factories\HasFactory

### Model: User
- **Namespace**: App\Models\User
- **Fields**: name, email, email_verified_at
- **Traits**: Illuminate\Database\Eloquent\Factories\HasFactory, Illuminate\Notifications\Notifiable

## 🌐 API & Controller Intelligence

## 🛡️ Security & Middleware Map

### Routes: web.php
- **Active Middleware**: None
- **Patterns**: Static Endpoints detected

### Routes: fabric.php
- **Active Middleware**: None
- **Patterns**: Static Endpoints detected

### Routes: auth.php
- **Active Middleware**: guest, auth
- **Patterns**: Static Endpoints detected

