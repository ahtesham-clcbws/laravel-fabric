# 🧙‍♂️ The Wizard: Interactive Installation

The `fabric:wizard` command is the recommended way to initialize a new project. It provides a guided, interactive experience to configure the Fabric engine to your specific needs.

## Guided Configuration

The Wizard will walk you through the following steps:

1. **Theme Selection**: Choose between `Tailwind` (Advanced) or `DaisyUI` (Component-based).
2. **Ecosystem Flags**: Enable/Disable features like:
   - **Soft Deletes**: Automatically handle `deleted_at`.
   - **Audit Trails**: Track every change via Spatie Activity Log.
   - **Permissions**: Enable granular RBAC via Spatie Permissions.
   - **Translations**: Scaffold multi-lingual input fields.
3. **Database Discovery**: Select which tables should be forged into resources immediately.
4. **Admin Setup**: Forge a "Seed Admin" user to jumpstart your development.

## Automated Readiness

At the end of the Wizard process, the following actions are performed:
- `fabric:install` is executed with your chosen settings.
- `fabric:assets` publishes all necessary components and layouts.
- `routes/fabric.php` is created and registered in `web.php`.
- A final pre-flight check (`fabric:ready`) is run to ensure the environment is healthy.

---

> [!TIP]
> You can re-run the Wizard at any time to add new resources or update your ecosystem settings.
