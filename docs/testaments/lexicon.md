# 📖 The Fabric Lexicon (Glossary)

To master the Forge, you must understand the language of the Loom. This glossary defines the codenames and architectural terms used throughout the Fabric ecosystem.

---

### 🧶 The Loom (Schema Introspection)
The **Loom** is the core engine that "reads" your database. It performs deep introspection to understand column types, relationships (`HasMany`, `BelongsTo`), and validation rules, weaving them into the generated stubs.

### 🔨 The Forge (Generation)
**Forging** is the act of generating high-fidelity code. When you run `fabric:generate`, you are not just "scaffolding"; you are forging a native, production-ready implementation of a business resource.

### 🕸️ Nexus (Relationship Graph)
The **Nexus** represents the interconnected web of your application's models. The `fabric:graph` command uses the Nexus engine to visualize these connections using Mermaid.js.

### 🏥 Lazarus (Self-Healing)
Named after the biblical figure, the **Lazarus** engine (`fabric:heal`) brings "dead" components back to life. When your database schema drifts (e.g., adding a new column), Lazarus surgically patches your existing code without overwriting your custom logic.

### ⚗️ The Alchemist (Transmutation)
The **Alchemist** engine (`fabric:alchemy`) allows you to transmute any static Blade file or HTML design into a dynamic Fabric-ready stub. It "distills" raw HTML into a reusable, smart component.

### 🛡️ Security Engine
**Security** is the multi-layered security engine. It handles both **Permissions ACL** (Role-Based Access Control) and the **Multi-Tenant Security**, which ensures strict data isolation between teams or organizations.

### 🔦 Spotlight (Global Palette)
**Spotlight** is the `Ctrl+K` command palette. It provides sub-100ms global search across every resource, action, and navigation point in your forged application.

### 👻 Ghost Scaffolding (The Zero-Dependency Philosophy)
**Ghost Scaffolding** is our core "Forge and Depart" philosophy. It means that Fabric remains invisible once the work is done. You can remove the package at any time, and the "Ghost" (the generated code) remains fully functional and native.

### 💎 Atoms (Atomic Components)
**Atoms** are the smallest building blocks of the UI (Buttons, Inputs, Badges). They are designed with the "Philosophy of Zero" to ensure they have no external runtime requirements.

### 🩺 The Doctor (Diagnostics)
The **Doctor** is the diagnostic suite that monitors the health of your environment, ensuring that your tech stack (PHP, Laravel, Tailwind) is in perfect parity with the Forge's requirements.

### 🧙 The Wizard (Interactive UX)
The **Wizard** is the guided CLI interface that walks you through complex multi-step generation processes, ensuring you make the right architectural decisions for your resources.

### 🧬 Dynasty (STI)
The **Dynasty** engine handles **Single Table Inheritance**. It allows multiple distinct models (e.g., `Admin`, `Member`) to share a single base table while maintaining strict type safety and automatic global scoping.

### 🌍 Polyglot (I18n)
The **Polyglot** engine provides native internationalization for PHP Enums. It "distills" multi-language labels into your UI without requiring external translation packages.

### 🧠 Cortex (Smart Cache)
**Cortex** is the relational caching engine. It provides high-performance model caching with automatic tag-based invalidation, ensuring your UI is fast without serving stale data.

### 🌪️ Vortex (Real-time)
**Vortex** is the event-driven real-time engine. It handles native WebSockets and Pusher/Reverb notifications, making your forged resources "alive" with instant updates.

### ⚡ Hydrate (High-Performance Seeding)
The **Hydrate** engine is a raw SQL power tool. It is designed to populate your database with millions of rows of relational data in seconds, bypassing Eloquent's overhead.

### 📸 Snapshot (Reverse Seeder)
**Snapshot** is the data portability engine. It allows you to "capture" the current state of a database table and export it as a portable PHP data stub for use across dev/staging environments.

### 📊 Analytics (Project Metrics)
**Analytics** provides deep insight into your codebase. The `fabric:analytics` command measures code density and calculates your "Forge ROI"—the exact number of lines Fabric saved you from writing.

### 🧹 Vacuum (Cleanup)
The **Vacuum** engine is the ultimate janitor. It surgically purges non-essential files from your `vendor` and `node_modules` folders, slimming down your deployment footprint.
