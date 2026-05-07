# The Extensibility Protocol
## Testament VIII: Infinite Horizons

Fabric is built to grow. However, growth must never come at the cost of our core philosophy: **Zero Runtime Dependency.** To extend Fabric, you must follow the **"Stubs-First"** doctrine.

---

### 🛡️ The Stubs-First Doctrine

If you want to add a new feature (e.g., integrating a third-party Analytics dashboard), **DO NOT** add a runtime class to the Fabric library. Instead:

1. **Create a new Stub**: Design the Blade and PHP stubs that contain the analytics logic.
2. **Weave via the Loom**: Add a detection hook in the `Loom` engine to identify when the analytics package is present.
3. **Forge via the Fabricator**: Update the `Fabricator` to inject the new stub when detected.

By doing this, the "Analytics" code is written directly into the user's project. When they uninstall Fabric, the analytics code remains and works perfectly because it is vanilla Laravel.

---

### 🧪 The Alchemist (Dynamic Stub Generation)

We have provided a specialized tool for extending the visual library: `php artisan fabric:alchemy`.

If you find a beautiful component on the web or design one yourself:
1. Run `php artisan fabric:alchemy`.
2. Paste the static HTML.
3. The engine will **Transmute** it into a dynamic stub by replacing hardcoded names and colors with placeholders like `{{ MODEL_NAME }}` and `{{ PRIMARY }}`.

**You can grow your visual library from 160 stubs to 1,000+ stubs in minutes just by feeding the Alchemist new designs.**

This allows you to add infinite new components to your visual lexicon in seconds.

---

### 🔌 Engine Swapping

Every core component of Fabric is bound via a **Contract** (Interface) in the `FabricServiceProvider`. If you want to change how the database is scanned:

1. Create a new class that implements `LoomContract`.
2. Re-bind the contract in your own Service Provider:
   ```php
   $this->app->singleton(LoomContract::class, MyAIPoweredLoom::class);
   ```

### 🏁 Final Thought
**"Extension is not about adding code to the engine; it's about teaching the engine how to write better code for you."**
