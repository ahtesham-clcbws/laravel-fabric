# Laravel Fabric: Extended Features List

A comprehensive list of everything Laravel Fabric brings to your project via the Native Ghost Plugin architecture.

### 🧬 Core Engine
- **Forging System**: Generate entire modules (Table + Editor + API) in seconds.
- **Stub-Based (Ghost Architecture)**: 100% customizable templates injected directly into your `app/` directory.
- **Zero-Dependency**: No proprietary DSL; no required 3rd-party vendor packages.
- **Multi-Library Support**: Native integration for DaisyUI, Preline, Meraki, etc.

### 📊 Data & Tables
- **Advanced Tables**: Search, Sort, and Filter by relationships out of the box.
- **Bulk Actions**: Mass selection and deletion with confirmation dialogs.
- **Hydrate (Raw SQL)**: High-fidelity, sub-second bulk seeding of relational data.
- **Snapshot Engine**: Capture live database tables into portable PHP data stubs.
- **Import/Export (IO Engine)**: Atomic, high-performance data extraction without Excel packages.

### ⚙️ System & Config
- **Deep Settings**: Database-backed application configuration system via `SettingsManager`.
- **Spotlight Search**: Global command palette (Ctrl+K) to find anything instantly.
- **Env Security**: CLI parity checks to prevent `.env` configuration drift.
- **Multi-Tenant Security**: Automatic data isolation via a single tenant key.
- **Cortex (Smart Cache)**: Relational model caching with tag-based invalidation.

### 🛡️ Security & Governance
- **Security Engine (RBAC)**: Native Role and Permission management (`HasRoles`).
- **Audit Trail**: Native tracking of model changes and user activity (`Auditable`).
- **Impersonation**: Admin ability to "Login As" any user for support.
- **System Jail**: Instant security lockdown mode for critical maintenance.
- **Time Machine**: Native database and asset backup engine.

### 🧠 Advanced Engines
- **Dynasty (STI)**: Native Single Table Inheritance support (`HasParent`).
- **Polyglot (Enums)**: Native multi-language translation support for PHP Enums.
- **Vortex (Real-time)**: Event-driven WebSockets and notification engine.
- **Analytics & Vacuum**: Code density metrics and vendor footprint reduction.
- **OmniDoc**: Native OpenAPI/Swagger documentation generation.

### 🌐 UI Component Extraction
- **fabric:component**: Extract high-fidelity UI sections from framework libraries (DaisyUI, Preline).
- **Universal Layouts**: Pre-configured website and dashboard layouts that sync with system settings.
- **SEO Optimized**: Automatic title, meta, and semantic HTML generation for all forged views.
