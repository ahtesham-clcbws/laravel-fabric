# 🕒 The Fabric Time-Machine (Native Versioning)

The Time-Machine is a high-fidelity extension of our auditing engine. It allows you to not only track changes but **revert** them with a single click.

## 🚀 How it Works
When a model uses the `Auditable` trait, every update is saved as a "Snapshot." The Time-Machine UI (built into the "Show" view) displays these snapshots as a timeline.

## 🛠️ Rollback Logic
```php
// Native rollback logic forged by Fabric
public function rollbackTo(int $activityId)
{
    $activity = Activity::findOrFail($activityId);
    $this->update($activity->old_values);
}
```

## ✨ Why it's a "Package Killer"
Most versioning packages are heavy and require complex setup. Fabric's Time-Machine is:
1.  **Zero-Dependency**: Uses your existing `activities` table.
2.  **Portable**: The logic is scaffolded directly into your resource controller.
3.  **Visual**: Provides a "Side-by-Side" diff of what changed before you hit rollback.
