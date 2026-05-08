# 📋 Audit Trail: Enterprise Transparency

Transparency and accountability are critical in enterprise applications. Fabric integrates seamlessly with `spatie/laravel-activitylog` to provide a high-fidelity audit trail for every forged resource.

## Automatic Tracking

When the `audit` flag is enabled during forging, Fabricator automatically:
- Injects activity logging into the forged models.
- Scaffolds an "Activity" tab in the "Show" and "Editor" views.
- Deep-links the user who performed the action.

## Key Insights
- **What Changed?**: A side-by-side comparison of old vs new values.
- **Who Did It?**: Full user context, including IP address and user agent.
- **When?**: High-precision timestamps for every event.

## Visual Logs
The Audit Trail UI uses color-coded badges to help administrators quickly identify `Created`, `Updated`, and `Deleted` events.

---

> [!TIP]
> Use the `fabric:log` command to view a real-time stream of audit events directly in your terminal.
