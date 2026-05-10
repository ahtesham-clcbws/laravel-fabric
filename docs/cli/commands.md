# 💻 Commands Reference

Fabric provides a comprehensive suite of artisan commands to manage your ghost scaffolding ecosystem.

---

## 🔨 Core Generation
### `fabric:generate {model}`
Forges a complete resource suite (Table, Editor, Show, and Test) for the given model.
- `--theme=`: Specify a design framework (daisyui, preline, hyperui, floatui, tailwind).
- `--runtime=`: Choose the engine (livewire, blade).
- `--tenant`: Activate the **Multi-Tenant Shield** (scopes to `team_id`).
- `--force`: Overwrite existing files.

### `fabric:component {name}`
Forges a high-fidelity UI block from the library lexicon.
- `name`: Framework:Component (e.g., `preline:button`, `daisyui:hero-section`).
- `--type=`: Variant (solid, soft, outline, ghost).
- `--size=`: Size (xs, sm, md, lg, xl).
- `--color=`: Palette color (primary, success, danger).
- `--icon=`: Lucide/Heroicon name to inject.

### `fabric:lexicon`
The interactive terminal-based explorer for 500+ forgeable blocks. Filter by library and category in real-time.

### `fabric:wizard`
The interactive companion. Guides you through the entire resource forging process step-by-step.

---

## 🛡️ Security & Identity
### `fabric:auth`
Generates a native Identity & Security engine including Profile management, Session control, and 2FA.

### `fabric:guard`
Enforces license gating and RBAC permissions across your generated resources.

### `fabric:jail`
Restricts access to specific models based on the Guard's security policies.

### `fabric:anon`
Anonymizes sensitive data in your database, essential for staging and development environments.

---

## 🚀 API & Integration
### `fabric:api {model}`
Forges a high-fidelity REST API (Resource + Controller) for the given model.

### `fabric:postman`
Forges a complete Postman Collection (`postman_collection.json`) mapping every model and action.

### `fabric:import {file}`
Bulk-imports data into your models from CSV or JSON with validation.

---

## 🩺 Health & Maintenance
### `fabric:doctor`
The primary diagnostic tool. Verifies environment health and detects missing ecosystem packages.

### `fabric:heal {model}`
The **Lazarus Engine**. Surgically patches existing components when database schemas change.

### `fabric:lint`
Analyzes and normalizes generated code to ensure it adheres to the **Universal Manifesto** standards.

### `fabric:vacuum`
Performs deep asset cleanup, removing unused styles and temporary forge artifacts.

### `fabric:purge`
Wipes all temporary and cached assets to force a fresh recompilation.

---

## ⚗️ Advanced Engineering
### `fabric:alchemy {path}`
Transmutes any static Blade file into a reusable Fabric stub.

### `fabric:context`
Generates a **Neural Context Map** for AI-pairing, helping LLMs understand your architecture.

### `fabric:graph`
Generates the **Nexus Graph**, a visual representation of your models' relationships.

### `fabric:sentry`
Injects performance guards (N+1 protection) into the application.

### `fabric:ready`
Comprehensive pre-flight deployment check to ensure all assets and guards are production-ready.

### `fabric:reverse {table}`
Snapshots an existing database table into a Laravel migration file.

### `fabric:assets`
Publishes the Fabric theme assets (Tailwind v4 config and CSS) to your project.

### `fabric:settings`
Forges a UI for managing Spatie-based settings classes.

### `fabric:hydrate`
Hydrates your database with high-fidelity, relational seed data.
