# Changelog

All notable changes to **Laravel Fabric** will be documented in this file.

## [v1.2.7-beta] - 2026-05-11
### Added
- **RSA-2048 Cryptography**: Implemented digital signature verification for licensing.
- **Wizard Post-Forge Hooks**: Interactive rituals for environment cleanup (Vacuum) and health checks (Doctor).
- **Master Security Keys**: Established asymmetric keypair for unforgeable project enrollment.

## [v1.2.6-beta] - 2026-05-11
### Fixed
- **Packagist Sync**: Resolved version mismatch by moving to tag-driven versioning.
- **Manifest Distribution**: Fixed missing `composer.json` in public repository sync.

## [v1.2.5-beta] - 2026-05-11
### Security
- **Total Stealth Registry**: Removed all literal Supabase credentials from public config files.
- **Credential Shadowing**: Injected registry keys directly into the protected PHAR runtime.

## [v1.2.4-beta] - 2026-05-11
### Added
- **PHAR Guard**: Enforced protected PHAR execution in production environments.
- **Proactive Eager Loading**: Automatic N+1 protection for generated resources.
- **STI (Dynasty) Scoping**: Automatic query scoping for Single Table Inheritance models.

## [v1.2.3-beta] - 2026-05-11
### Changed
- **Triple-Repo Orchestration**: Restructured project into Core (Private), Distribution (Public), and Docs (Public).
- **Forge Release Engine**: Automated sync between all three repositories.

## [v1.2.0-beta] - 2026-05-10
### Added
- **Native Ghost Plugins**: Transitioned to zero-dependency native components for Permissions, Media, and Auditing.
- **Lazarus 2.0**: Implemented surgical structural healing engine with `--dry-run` support.
