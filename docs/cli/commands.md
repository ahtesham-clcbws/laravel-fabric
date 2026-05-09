# 💻 Commands Reference

Fabric provides a comprehensive suite of artisan commands to manage your ghost scaffolding ecosystem.

## 🔨 Core Generation
### `fabric:generate {model}`
Forges a complete resource suite (Table, Editor, Show, and Test) for the given model.
- `--theme=`: Specify a design framework (daisyui, preline, hyperui, floatui, tailwind).
- `--runtime=`: Choose the engine (livewire, blade).
- `--tenant`: Activate the **Multi-Tenant Shield** (scopes to `team_id`).
- `--force`: Overwrite existing files.
- `--sort=`: Initial sort column.
- `--direction=`: Initial sort direction (asc/desc).

### `fabric:component {template:section}`
Extracts a specific high-fidelity UI section from a Fabric template.
- `template`: The framework name (e.g., `daisyui`).
- `section`: The component name (e.g., `hero`, `navbar`).
- Example: `php artisan fabric:component daisyui:hero`

### `fabric:wizard`
The interactive companion. Guides you through the entire resource forging process step-by-step.

### `fabric:list {template?}`
Lists all available frameworks and their indexed components.
- `template`: Optional filter by framework name.

## 🛡️ Identity & Security
### `fabric:auth`
Generates a native Identity & Security engine. Includes Profile management, Session control, and standard authentication views without external dependencies.

### `fabric:api {model}`
Forges a high-fidelity REST API (Resource + Controller) for the given model. Automatically configures Laravel 13's slim skeleton API.

### `fabric:guard`
Enforces license gating and RBAC permissions across your generated resources.

### `fabric:jail`
Restricts access to specific models based on the Guard's security policies.

## 🩺 Diagnostics & Maintenance
### `fabric:doctor`
The primary diagnostic tool. Verifies environment health, PHP/Laravel versions, and detects missing ecosystem packages.

### `fabric:heal {model}`
The **Lazarus Engine**. Surgically patches existing components when your database schema changes, injecting new fields while preserving your custom logic.

### `fabric:lint`
Analyzes and normalizes generated code to ensure it adheres to the **Universal Manifesto** standards.

### `fabric:vacuum`
Performs deep asset cleanup, removing unused styles, scripts, and temporary forge artifacts.

## ⚗️ Advanced Engines
### `fabric:alchemy {path}`
Transmutes any static Blade file into a reusable Fabric stub.

### `fabric:context`
Generates a **Neural Context Map** for AI-pairing, helping LLMs understand your project's architecture and relationships.

### `fabric:graph`
Generates the **Nexus Graph**, a visual representation of your models' relationships and data flow.

### `fabric:anon`
Anonymizes sensitive data in your database, essential for staging and development environments.

---

### 🚀 Usage Note
Most commands are designed for local development. Use `fabric:ready` before deploying to ensure all assets are optimized and guards are active.
