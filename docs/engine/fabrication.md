# 🏗️ Fabricator: The Generative Engine

The **Fabricator** is the core orchestration engine of Laravel Fabric. It transforms raw database introspection data into production-ready Livewire components, views, and logic.

## How it Works

Fabricator works in tandem with the **Loom** (Introspection) and the **Alchemist** (Stubs) to weave a complete resource.

1. **Introspection**: Loom scans the table for types, relationships, and constraints.
2. **Weaving**: Fabricator maps these to specific UI components and validation rules.
3. **Forging**: Alchemist injects the dynamic logic into high-fidelity stubs.
4. **Publishing**: The final files are written to your `app/Livewire/Fabric` and `resources/views/livewire/fabric` directories.

## Core Features

### Atomic Component Mapping
Fabricator doesn't just generate text inputs; it maps database types to specific Atomic Components:
- `boolean` -> `<x-fabric::toggle />`
- `text/longtext` -> `<x-fabric::textarea />`
- `foreignId` -> `<x-fabric::select />` with searchable relationships.
- `datetime` -> Flatpickr-powered date inputs.

### Zero-Dependency Logic
Every component forged by Fabricator is self-contained. It generates:
- Full CRUD methods (Create, Read, Update, Delete).
- Real-time validation rules derived from column constraints.
- Sorting and searching logic that works directly with Eloquent.

## Advanced Forging

### Soft Delete Support
If a table has a `deleted_at` column, Fabricator automatically enables:
- "Show Trashed" filters.
- "Restore" actions in the UI.
- Conditional authorization for force-deletion.

### Relationship Weaving
Fabricator detects `belongsTo` and `belongsToMany` relationships and automatically:
- Scaffolds select dropdowns with searchable model data.
- Implements pivot table sync logic for many-to-many relationships.
- Deep-links related resources in the "Show" view.

---

> [!TIP]
> You can customize the forging process by overriding the stubs in your project using `php artisan fabric:stubs`.
