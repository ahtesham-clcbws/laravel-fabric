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

### 🛡️ Shield (Security & Isolation)
**Shield** is the multi-layered security engine. It handles both **Shield ACL** (Role-Based Access Control) and the **Multi-Tenant Shield**, which ensures strict data isolation between teams or organizations.

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
