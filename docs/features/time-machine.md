# ⏳ Time Machine: Instant Data Recovery

The **Time Machine** is Fabric's advanced interface for managing Soft Deletes and historical data states.

## Beyond Trash

While standard Laravel Soft Deletes allow you to hide records, the Time Machine provides a dedicated UI to manage the lifecycle of these records.

### Features
- **Global Trash View**: A centralized dashboard to view all deleted records across all resources.
- **Instant Restore**: One-click restoration of records and their associated relationships.
- **Audit Integration**: See *who* deleted a record and *why* directly from the trash view.

## Integration with Lazarus

The Time Machine works with the **Lazarus** engine to perform "Deep Restoration"—restoring a record along with its child relationships that were also soft-deleted at the same time.

---

> [!NOTE]
> Time Machine requires the `SoftDeletes` trait to be present on your models.
