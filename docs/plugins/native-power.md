# 🧬 Native Power: Zero-Dependency Ecosystem

Fabric is designed to be a **"Package Killer"**. We believe that your application should not be a house of cards built on 50 different vendor dependencies. Fabric allows you to inject high-fidelity, native Laravel code for all essential features, giving you 100% ownership and zero vendor lock-in.

## 🛡️ The "Ghost" Philosophy
When you install a Fabric Native Plugin, you aren't installing a package. You are **injecting code**. 
- **Ownership**: The models, migrations, and traits are written directly into your `app/` and `database/` directories.
- **Zero Lock-in**: You can remove the `clcbws/laravel-fabric` package at any time, and your application will continue to function perfectly.
- **Performance**: Native code means zero overhead from package service providers or complex vendor configurations.

## 🧠 Intelligent Hybrid Detection
Fabric is smart. It respects your existing stack. If you are already using a third-party package (like Spatie Permissions), Fabric will detect it and:
1. **Pivot**: It will not inject the native version to prevent collisions.
2. **Adapt**: The Fabric Forge (generators) will automatically adapt their generated code to work with your existing third-party package.

## 🛠️ The Orchestration Command
Use the `fabric:plugin` command to manage your native ecosystem.

```bash
# Audit your project and install all missing native features
php artisan fabric:plugin

# Install a specific native plugin (e.g. Security)
php artisan fabric:plugin permissions

# Run a dry-run to see what would be injected
php artisan fabric:plugin --dry-run
```

## 🩺 Ecosystem Audit
Run the doctor to see the health of your native ecosystem:
```bash
php artisan fabric:doctor
```
The doctor will perform a deep audit, showing you which features are **Native Active**, which are **Using 3rd-Party**, and which are **Native Ready** for migration.

---

## 📦 Native Plugin Registry
Below are the core "Package Killers" available in Fabric:

| Plugin | Replaces Package | Native Capability |
| :--- | :--- | :--- |
| **Security** | Spatie Permission | Native RBAC & ACL |
| **Lean Media** | Spatie MediaLibrary | Native Polymorphic Media |
| **Audit Trail** | Spatie ActivityLog | Native Activity Auditing |
| **Time Machine** | Spatie Backup | Native DB/Asset Backups |
| **Cortex** | Smart Cache | Native Relational Caching |
| **Vortex** | Pusher / Reverb | Native Real-time Events |
| **Hydrate** | Populate | Raw SQL Bulk Seeding |
| **Dynasty** | Tighten Parental | Single Table Inheritance |
| **Polyglot** | Enum Translatable | Multi-language Enums |
| **OmniDoc** | L5-Swagger | Native OpenAPI Generator |
| **Sluggable** | Eloquent Sluggable | Native URL Slug Generation |
| **Identity** | Unique IDs | Native ULID/UUID Identity |
| **Analytics** | TomasVotruba Lines | Native Code Density Metrics |
| **Vacuum** | Vendor Cleanup | Native Node/Vendor Purging |
| **Loom API** | Laravel Introspect | Native Schema Metadata API |
| **Nexus Hook** | Spatie Webhooks | Native Outbound Webhooks |
| **Postman** | Laravel Postman | Native Collection Generation |
| **Doctor** | Diagnostic Tools | Native Health Diagnostics |
| **Lazarus** | Manual Patching | Native Surgical Healing |
| **Snapshot** | Seeder Generator | Native DB Data Portability |
