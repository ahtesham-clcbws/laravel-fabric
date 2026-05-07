# The Book of Answers
## Testament VII: Frequently Asked Questions

Welcome to the definitive source of truth for Laravel Fabric. Here, we address the most common technical and architectural inquiries.

---

### 🛡️ Core Philosophy & Runtime

#### Q: If I uninstall Fabric after generating my UI, will it break my project?
**A:** A definitive **NO**. Fabric follows a strictly decoupled **"Forge and Depart"** architecture. It writes **vanilla** Laravel, Livewire, and Blade code directly into your project. There is no vendor lock-in; once forged, the code is 100% yours and has zero dependency on the package at runtime.

#### Q: Is there any performance overhead when using Fabric?
**A:** Zero. Because Fabric generates standard Laravel code, your application performs exactly as if a human developer wrote it. There are no heavy base classes or proprietary traits slowing down your requests.

---

### 🔄 Maintenance & Customization

#### Q: How do I refresh a resource without losing my custom logic?
**A:** Fabric uses a unique **Hook Injection System**. Every forged file contains `[FABRIC-HOOK]` comments (e.g., `<!-- [FABRIC-HOOK:FORM-TOP] -->`). If you place your custom logic between or after these hooks, Fabric will preserve it during re-generation.

#### Q: Can I use Fabric with existing models and a pre-populated database?
**A:** Yes. Fabric is designed to "Loom" over any existing database. It will introspect your schema, detect relationships (even without foreign keys using name heuristics), and forge a UI that matches your data instantly.

---

### 🎨 Design & Ecosystem

#### Q: Can I add my own custom Design System?
**A:** Absolutely. You can publish the stubs using `php artisan fabric:stubs` and modify them, or add a new folder in `stubs/livewire` to create a completely new visual soul for your application.

#### Q: What if my database doesn't have foreign keys?
**A:** The **Loom Engine** is intelligent. If it sees a column like `user_id`, it will look for a `User` model and automatically propose a relationship-aware select field, even if the database doesn't have a formal constraint.

---

### 🚀 Advanced Features

#### Q: Does Fabric support API generation?
**A:** While Fabric v1.0.0 focuses on the Livewire stack (Tailwind/DaisyUI), the underlying Loom engine provides a Data Contract that can be used to forge API Resources and Controllers. This is a priority for the v1.1 roadmap.

#### Q: Is it compatible with Laravel 11 and PHP 8.3?
**A:** Yes. Fabric is built for the modern Laravel ecosystem, fully supporting PHP 8.1+ Enums, Readonly properties, and the latest Livewire v3 features.

---

### 🏁 Final Thought
**"Fabric is the Super-Developer you wish you could hire—fast, accurate, and completely invisible once the job is done."**
