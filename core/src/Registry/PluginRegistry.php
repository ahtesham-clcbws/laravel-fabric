<?php

namespace CLCBWS\Fabric\Registry;

class PluginRegistry
{
    public static function all(): array
    {
        return [
            'permissions' => [
                'name' => 'Fabric Security (Permissions)',
                'competitors' => [
                    'Spatie\Permission\Models\Role',
                ],
                'stubs' => [
                    'security/models/Role.php.stub' => 'Models/Permissions/Role.php',
                    'security/models/Permission.php.stub' => 'Models/Permissions/Permission.php',
                    'security/traits/HasRoles.php.stub' => 'Traits/Permissions/HasRoles.php',
                    'security/migrations/create_permissions_table.php.stub' => 'migrations/{{timestamp}}_create_permissions_table.php',
                    'security/views/roles-and-permissions.blade.php.stub' => '../resources/views/fabric/security/roles-and-permissions.blade.php',
                ],
            ],
            'media' => [
                'name' => 'Lean Media',
                'competitors' => [
                    'Spatie\MediaLibrary\MediaCollections\Models\Media',
                ],
                'stubs' => [
                    'media/models/Media.php.stub' => 'Models/Media/Media.php',
                    'media/traits/InteractsWithMedia.php.stub' => 'Traits/Media/InteractsWithMedia.php',
                    'media/migrations/create_media_table.php.stub' => 'migrations/{{timestamp}}_create_media_table.php',
                ],
            ],
            'settings' => [
                'name' => 'Deep Settings',
                'competitors' => [
                    'Spatie\LaravelSettings\Settings',
                ],
                'stubs' => [
                    'settings/models/Setting.php.stub' => 'Models/Settings/Setting.php',
                    'settings/services/SettingsManager.php.stub' => 'Services/Settings/SettingsManager.php',
                    'settings/migrations/create_settings_table.php.stub' => 'migrations/{{timestamp}}_create_settings_table.php',
                ],
            ],
            'audit' => [
                'name' => 'Audit Trail',
                'competitors' => [
                    'Spatie\Activitylog\Models\Activity',
                ],
                'stubs' => [
                    'audit/models/Audit.php.stub' => 'Models/Audit/Audit.php',
                    'audit/traits/Auditable.php.stub' => 'Traits/Audit/Auditable.php',
                    'audit/migrations/create_audits_table.php.stub' => 'migrations/{{timestamp}}_create_audits_table.php',
                ],
            ],
            'backups' => [
                'name' => 'Time Machine (Backups)',
                'competitors' => [
                    'Spatie\Backup\Commands\BackupCommand',
                ],
                'stubs' => [
                    'backups/models/Backup.php.stub' => 'Models/Backups/Backup.php',
                    'backups/services/BackupEngine.php.stub' => 'Services/Backups/BackupEngine.php',
                    'backups/migrations/create_backups_table.php.stub' => 'migrations/{{timestamp}}_create_backups_table.php',
                ],
            ],
            'tenancy' => [
                'name' => 'Multi-Tenancy Security',
                'competitors' => [
                    'Stancl\Tenancy\Tenancy',
                ],
                'stubs' => [
                    'tenancy/models/Tenant.php.stub' => 'Models/Tenancy/Tenant.php',
                    'tenancy/traits/BelongsToTenant.php.stub' => 'Traits/Tenancy/BelongsToTenant.php',
                    'tenancy/migrations/create_tenants_table.php.stub' => 'migrations/{{timestamp}}_create_tenants_table.php',
                ],
            ],
            'vortex' => [
                'name' => 'Vortex (WebSockets)',
                'competitors' => [
                    'Laravel\Reverb\Server',
                ],
                'stubs' => [
                    'vortex/models/NativeNotification.php.stub' => 'Models/Vortex/NativeNotification.php',
                    'vortex/services/VortexBroadcaster.php.stub' => 'Services/Vortex/VortexBroadcaster.php',
                    'vortex/channels/NativeChannel.php.stub' => 'Channels/Vortex/NativeChannel.php',
                ],
            ],
            'nexus-hook' => [
                'name' => 'Nexus Hook (Webhooks)',
                'competitors' => [
                    'Spatie\WebhookServer\WebhookCall',
                ],
                'stubs' => [
                    'nexus-hook/models/Webhook.php.stub' => 'Models/NexusHook/Webhook.php',
                    'nexus-hook/jobs/WebhookJob.php.stub' => 'Jobs/NexusHook/WebhookJob.php',
                    'nexus-hook/migrations/create_webhooks_table.php.stub' => 'migrations/{{timestamp}}_create_webhooks_table.php',
                ],
            ],
            'io' => [
                'name' => 'Import/Export Engine',
                'competitors' => [
                    'Maatwebsite\Excel\Excel',
                ],
                'stubs' => [
                    'import/services/Importer.php.stub' => 'Services/Import/Importer.php',
                    'export/services/Exporter.php.stub' => 'Services/Export/Exporter.php',
                ],
            ],
            'omnidoc' => [
                'name' => 'OmniDoc (Swagger)',
                'competitors' => [
                    'L5Swagger\L5SwaggerServiceProvider',
                ],
                'stubs' => [
                    'omnidoc/services/OpenApiGenerator.php.stub' => 'Services/OmniDoc/OpenApiGenerator.php',
                    'omnidoc/views/swagger.blade.php.stub' => '../resources/views/fabric/omnidoc/swagger.blade.php',
                ],
            ],
            'dynasty' => [
                'name' => 'Dynasty (STI)',
                'competitors' => [
                    'Tightenco\Parental\HasParent',
                ],
                'stubs' => [
                    'dynasty/traits/HasParent.php.stub' => 'Traits/Dynasty/HasParent.php',
                ],
            ],
            'polyglot' => [
                'name' => 'Polyglot (Enum Translation)',
                'competitors' => [
                    'Yasintqvi\EnumTranslatable\EnumTranslatable', // Example competitor
                ],
                'stubs' => [
                    'polyglot/traits/TranslatableEnum.php.stub' => 'Traits/Polyglot/TranslatableEnum.php',
                ],
            ],
            'analytics' => [
                'name' => 'Analytics (LOC)',
                'competitors' => [
                    'TomasVotruba\Lines\LinesServiceProvider',
                ],
                'stubs' => [
                    'analytics/services/CodeAnalytics.php.stub' => 'Services/Analytics/CodeAnalytics.php',
                ],
            ],
            'vacuum-vendor' => [
                'name' => 'Vacuum (Vendor Cleanup)',
                'competitors' => [
                    'Leek\VendorCleanup\CleanupServiceProvider',
                ],
                'stubs' => [
                    'vacuum/services/VendorCleaner.php.stub' => 'Services/Vacuum/VendorCleaner.php',
                ],
            ],
            'sluggable' => [
                'name' => 'Sluggable Models',
                'competitors' => [
                    'Cviebrock\EloquentSluggable\Sluggable',
                ],
                'stubs' => [
                    'sluggable/traits/HasSlug.php.stub' => 'Traits/Sluggable/HasSlug.php',
                ],
            ],
            'identity' => [
                'name' => 'Identity (Unique IDs)',
                'competitors' => [
                    'Willvincent\LaravelUnique\HasUniqueIds',
                ],
                'stubs' => [
                    'identity/traits/HasUniqueIds.php.stub' => 'Traits/Identity/HasUniqueIds.php',
                ],
            ],
            'snapshot' => [
                'name' => 'Snapshot (Reverse Seeder)',
                'competitors' => [
                    'Tyghaykal\LaravelSeederGenerator\SeederGenerator',
                ],
                'stubs' => [
                    'snapshot/services/SnapshotService.php.stub' => 'Services/Snapshot/SnapshotService.php',
                ],
            ],
            'doctor' => [
                'name' => 'Doctor (Diagnostics)',
                'competitors' => [],
                'stubs' => [
                    'doctor/services/DiagnosticDoctor.php.stub' => 'Services/Doctor/DiagnosticDoctor.php',
                ],
            ],
            'lazarus' => [
                'name' => 'Lazarus (Healing)',
                'competitors' => [],
                'stubs' => [
                    'lazarus/services/HealerService.php.stub' => 'Services/Lazarus/HealerService.php',
                ],
            ],
        ];
    }
}
