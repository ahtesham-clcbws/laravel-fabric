# 🌐 Headless API Forge

The API Forge (`fabric:api`) allows you to instantly generate a RESTful API layer for your models. This is perfect for building mobile apps, external integrations, or headless frontends.

## 🔨 Command
```bash
php artisan fabric:api Post
```

## 📦 What is Generated?

### 1. Eloquent Resource (`App\Http\Resources\PostResource`)
Fabric introspects your model and forges a dedicated Resource class. This ensures your API responses are clean, standardized, and decoupled from your database structure.

### 2. API Controller (`App\Http\Controllers\Api\PostApiController`)
A high-fidelity controller with the following standard REST endpoints:
- `GET /api/posts`: Paginated index.
- `POST /api/posts`: Resource creation with validation.
- `GET /api/posts/{id}`: Individual record detail.
- `PUT /api/posts/{id}`: Resource update.
- `DELETE /api/posts/{id}`: Resource removal.

## 🚀 Laravel 13 Integration
In Laravel 13, API routes are not enabled by default. Fabric detects this and provides the exact command needed to initialize the API layer:

```bash
php artisan install:api
```

Once installed, simply register your new resource in `routes/api.php`:

```php
Route::apiResource('posts', \App\Http\Controllers\Api\PostApiController::class);
```

## 🔒 Security & Versioning
We recommend wrapping your Fabric-forged API routes in standard Laravel middleware (like `auth:sanctum`) to ensure secure data access.
