# 💻 Commands Reference

Fabric provides a powerful suite of artisan commands to manage your scaffolding ecosystem.

## 🔨 Core Generation
### `fabric:generate {model}`
Forges a complete resource suite (Table, Editor, Show, and Test).
- `--tenant`: Activate the **Multi-Tenant Shield**. Automatically scopes all queries to `team_id`.
- `--theme=`: Specify a custom theme (daisyui, tailwind, etc).

### `fabric:heal {model}`
The **Lazarus Engine**. Surgically patches your existing components when your database schema changes. It injects new fields without touching your custom code.

### `fabric:wizard`
The interactive companion. Guides you through the forge process.

### `fabric:api {model}`
Forges a high-fidelity REST API (Resource + Controller) for the given model. Automatically guides you through Laravel 13's slim skeleton API setup.

### `fabric:auth`
Generates a native Identity & Security engine. Includes Profile management, Session control, and standard authentication views without external dependencies like Breeze.

## 🧪 Diagnostics & Assets
### `fabric:doctor`
Verifies your environment's health. Checks PHP/Laravel versions and detects missing ecosystem packages (Spatie, Scout, etc.).

### `fabric:assets`
Publishes the atomic UI components and dashboard layouts to your project. Run this after installation or when updating themes.

## ⚗️ Advanced
### `fabric:alchemy {path}`
Transmutes a static Blade file into a Fabric stub.

---

# 🧩 Relational Components

Fabric's true power lies in its ability to handle complex relational data.

## 🔗 BelongsTo (Parent Selection)
Relationships are automatically forged as **Searchable Select** inputs. The engine identifies the most relevant label column (e.g., `name`, `title`, `email`) using the Loom's label-detection algorithm.

## 🕸️ HasMany (Nested Tables)
One-to-many relationships are forged as **Livewire Tables** nested within the "Show" view. This allows you to view related records (e.g., a User's Posts) without navigating away from the parent record.

## 🔄 ManyToMany (Pivot Sync)
Many-to-many relationships are forged as **Multi-Select** inputs. On save, the engine automatically handles the `sync()` logic to persist associations in the pivot table.

---

# 🖼️ Media & File Handling

Fabric provides zero-config support for **Spatie Media Library**.

## 📤 Automatic Uploaders
If the Loom detects a column flagged for media or a `HasMedia` trait, it forges a **File Upload** component in the Editor.

## 🖼️ Gallery Previews
In the "Show" view, media fields are rendered as **Professional Image Previews** with automatic fallback to file icons for non-image assets.
