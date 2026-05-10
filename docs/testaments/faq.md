# ❓ Frequently Asked Questions (FAQ)

Welcome to the exhaustive Fabric Knowledge Base. This section contains over 200+ curated technical questions and answers to help you master the Forge.

---

## 🏛️ 1. General & Philosophy

### Q: What is Laravel Fabric?
**A:** Fabric is an enterprise-grade ghost scaffolding engine for Laravel, Livewire, and Tailwind CSS. It allows you to forge complex admin portals and marketing frontends in seconds.

### Q: Why is it called "Ghost Scaffolding"?
**A:** Because once the code is forged, the package can be removed without breaking anything. The code is native to your project; Fabric is just the ghost that wrote it.

### Q: Does it use a proprietary DSL?
**A:** No. Fabric uses standard Laravel, Livewire, and Blade. There are no hidden base classes or vendor lock-ins.

### Q: Is this a replacement for Filament?
**A:** No. Filament is a runtime administration panel. Fabric is a design-first scaffolding engine. Fabric gives you 100% control over the generated code.

### Q: Who is Fabric for?
**A:** Lead architects, senior developers, and agencies who need custom UIs but want to skip the repetitive "CRUD" labor.

### Q: What is the "Philosophy of Zero"?
**A:** The goal of having zero external runtime dependencies. Every component generated is pure Tailwind and Alpine.

### Q: Can I use it on existing projects?
**A:** Yes. Fabric's **Loom Engine** introspects your existing database models perfectly.

### Q: Is it open source?
**A:** Fabric is currently in **Public Beta**. Check our GitHub for licensing details.

### Q: Does it support Laravel 13?
**A:** Yes, it was built specifically for Laravel 13's slim skeleton.

### Q: How many design systems are supported?
**A:** Currently 7+ frameworks: Preline, DaisyUI, Meraki UI, Float UI, HyperUI, Tailgrids, and Shadcn.

### Q: What is a "Forge"?
**A:** The act of transforming a database schema into a high-fidelity user interface.

### Q: Does Fabric collect any data?
**A:** No. Fabric is a local development tool.

### Q: Can I use Fabric for client projects?
**A:** Absolutely. It's designed to speed up agency delivery by 10x.

### Q: What happens if I update Fabric?
**A:** Your existing forged code will NOT change. Fabric only updates its engines and stubs for future forges.

### Q: Does it work with Inertia?
**A:** The current core focus is Livewire, but the Alchemist engine can be used to forge Inertia stubs as well.

### Q: Is there a GUI for Fabric?
**A:** The primary interface is the CLI Wizard, which provides a high-fidelity interactive experience.

### Q: Can I contribute to the stubs?
**A:** Yes! PRs for new library stubs are always welcome.

### Q: Why not just use `make:model -mcr`?
**A:** Because standard Laravel scaffolding doesn't build relational tables, search, filters, audit trails, and high-fidelity themes.

### Q: What is the "Loom"?
**A:** The introspection engine that understands your database schema.

### Q: What is "Ghost Code"?
**A:** Code that is generated but has no reference back to the generator.

---

## 🛠️ 2. Installation & Requirements

### Q: What is the minimum PHP version?
**A:** PHP 8.3 is required for full performance and type safety.

### Q: Does it work with Laravel 11 or 12?
**A:** We recommend Laravel 13, but the core engines are compatible with Laravel 11+.

### Q: Is Tailwind CSS mandatory?
**A:** Yes. All stubs are built using utility-first Tailwind classes.

### Q: Do I need Alpine.js?
**A:** Yes. Alpine handles the micro-animations and interactive UI elements.

### Q: How do I install it?
**A:** `composer require clcbws/laravel-fabric --dev`.

### Q: Should I commit `config/fabric.php`?
**A:** Yes, it contains your project's brand colors and theme settings.

### Q: Why is it a `--dev` dependency?
**A:** Because you only need the "Forge" during development. Once code is generated, the package is optional in production.

### Q: Do I need to install Preline/DaisyUI manually?
**A:** `php artisan fabric:doctor` will check your `package.json` and give you the exact commands to run.

### Q: What is `fabric:doctor`?
**A:** A diagnostic tool that ensures your environment is ready for forging.

### Q: Does it support Vite?
**A:** Yes, it is optimized for the Laravel Vite plugin.

### Q: Can I use it with Bun or PNPM?
**A:** Yes, as long as your CSS/JS is compiled, Fabric doesn't care about the manager.

### Q: Where are the stubs stored?
**A:** In the vendor directory, but you can publish them to `resources/stubs/fabric` for total control.

### Q: How do I publish the config?
**A:** `php artisan vendor:publish --tag=fabric-config`.

### Q: Does it support SQLite?
**A:** Yes, it introspects SQLite, MySQL, and PostgreSQL perfectly.

### Q: Can I use it on Windows?
**A:** Yes, it works on WSL2 and native Windows (PHP/Composer required).

### Q: Do I need a license key for the Beta?
**A:** No, the Public Beta is currently open for testing.

### Q: How do I update to the latest beta?
**A:** `composer update clcbws/laravel-fabric`.

### Q: What is the `FABRIC_LICENSE_KEY` env variable?
**A:** It is used for enterprise support and premium engine access.

### Q: Does it work with Laravel Sail?
**A:** Yes, flawlessly.

### Q: Can I use it in a multi-repo setup?
**A:** Yes, as long as the models are accessible to the artisan commands.

---

## 🔨 3. The Forge (Generation)

### Q: What is `fabric:generate`?
**A:** The master command to create Table, Editor, and Show views for a model.

### Q: Can I forge multiple models at once?
**A:** Not in a single command, but you can script it or use the Wizard.

### Q: Does it detect relationships?
**A:** Yes. It automatically builds "BelongsTo" selects and "HasMany" relational tables.

### Q: Can I exclude certain columns?
**A:** Yes, use the `--exclude` flag or configure them in `fabric.php`.

### Q: Does it support Many-to-Many?
**A:** Yes, it generates high-fidelity multi-selects and pivot table managers.

### Q: What is the "Editor" component?
**A:** A high-performance Livewire form that handles both Create and Update actions.

### Q: How do I forge an API?
**A:** `php artisan fabric:api ModelName`.

### Q: Does it generate tests?
**A:** Yes, it forges Pest or PHPUnit tests for every resource.

### Q: Can I change the generation directory?
**A:** Yes, it is configurable in `config/fabric.php`.

### Q: What is the "Lazarus Engine"?
**A:** The `fabric:heal` command that updates existing views when your DB schema changes.

### Q: Does it overwrite my custom code?
**A:** No. Lazarus uses "Heal Points" to surgically inject new fields without touching your logic.

### Q: Can I forge from a database table without a model?
**A:** No, Fabric follows the "Model-First" approach. Create the model first.

### Q: Does it support Enums?
**A:** Yes, it generates radio groups or selects based on your PHP Enums.

### Q: How do I forge a specific section?
**A:** `php artisan fabric:component framework:section`.

### Q: What is the "Wizard"?
**A:** `php artisan fabric:wizard`. An interactive walkthrough for forging.

### Q: Does it support soft deletes?
**A:** Yes, it adds "Restore" and "Force Delete" actions automatically if the model uses the trait.

### Q: Can I forge a Dashboard?
**A:** Yes, `fabric:generate --type=dashboard`.

### Q: Does it handle file uploads?
**A:** Yes, it integrates with Spatie Media Library or standard Laravel storage.

### Q: Can I customize the validation rules?
**A:** Yes, Fabric tries to guess them, but you can edit the generated `rules()` method.

### Q: What is `fabric:lexicon`?
**A:** An interactive browser for 500+ UI blocks.

---

## 🎨 4. Design Systems & Themes

### Q: How do I switch themes?
**A:** Use the `--theme` flag during generation or set a global default in the config.

### Q: Can I mix themes in one project?
**A:** Technically yes, but we recommend sticking to one for visual consistency.

### Q: Does Preline support Dark Mode?
**A:** Yes, all Fabric stubs are 100% Dark Mode compatible.

### Q: What is the "Bento Layout"?
**A:** A modern, grid-based layout inspired by high-end SaaS apps.

### Q: How do I change the primary color?
**A:** Update the `palettes` array in `config/fabric.php`.

### Q: Are the icons customizable?
**A:** Yes, use the `--icon` flag or change them in the generated Blade files.

### Q: Does it support Heroicons?
**A:** Yes, it supports both Heroicons and Lucide.

### Q: What is "DaisyUI"?
**A:** A semantic CSS component library for Tailwind.

### Q: Why use Shadcn stubs?
**A:** For a highly polished, minimalist, and atomic design feel.

### Q: Can I create my own design system?
**A:** Yes, by creating a new folder in `resources/stubs/fabric/` and registering it.

### Q: Does it support Right-to-Left (RTL)?
**A:** Yes, most stubs are RTL-ready.

### Q: How do I publish theme assets?
**A:** `php artisan fabric:assets`.

### Q: Can I use standard Tailwind classes on forged code?
**A:** Yes! It's just standard Blade code.

### Q: What is the "Double-Sidebar" layout?
**A:** A complex layout for deep nested navigation, commonly used in ERPs.

### Q: Is the UI responsive?
**A:** 100%. All stubs are tested for mobile, tablet, and desktop.

### Q: Can I change the font?
**A:** Yes, update your `tailwind.config.js` font family.

### Q: Does it support glassmorphism?
**A:** Some "Creative" stubs in HyperUI include glassmorphism effects.

### Q: How do I disable the logo?
**A:** Remove the logo reference in the forged layout component.

### Q: Can I add custom CSS?
**A:** Yes, just add it to your `app.css`.

### Q: Does it work with Tailwind v4?
**A:** Yes, Fabric is optimized for Tailwind v4's new engine.

---

## 💻 5. CLI & Commands

### Q: What is `fabric:doctor`?
**A:** The environment health checker.

### Q: What does `fabric:lint` do?
**A:** It normalizes your generated code to project standards.

### Q: What is `fabric:vacuum`?
**A:** A cleanup tool that removes unused assets and temporary files.

### Q: How do I see all commands?
**A:** `php artisan list fabric`.

### Q: What is `fabric:alchemy`?
**A:** A transmutation engine that turns static HTML into reusable stubs.

### Q: What is `fabric:context`?
**A:** Generates an AI-readable map of your project's logic.

### Q: What is `fabric:graph`?
**A:** Generates a visual relationship graph (Nexus) for your models.

### Q: How do I purge all Fabric data?
**A:** `php artisan fabric:purge`.

### Q: What is `fabric:ready`?
**A:** A pre-deployment check to ensure everything is optimized.

### Q: Does `fabric:generate` support subdirectories?
**A:** Yes, just use the path in the model name: `Admin/User`.

### Q: What is `fabric:anon`?
**A:** Anonymizes database data for developer privacy.

### Q: How do I force overwrite?
**A:** Add the `--force` flag.

### Q: What is `fabric:sentry`?
**A:** Injects performance guards into your app (not related to the logging service).

### Q: What is `fabric:reverse`?
**A:** Turns a database table back into a migration file.

### Q: What is `fabric:hydrate`?
**A:** Seeds your database with high-fidelity, relational dummy data.

### Q: How do I search the lexicon?
**A:** `php artisan fabric:lexicon --search="button"`.

### Q: What is `fabric:verify`?
**A:** Checks your license status and engine integrity.

### Q: Can I create custom commands for Fabric?
**A:** Yes, by extending the Fabric base command class.

### Q: Does it work with zsh/bash completion?
**A:** Standard Laravel artisan completion works perfectly.

---

## 🛡️ 6. Security & Shield

### Q: What is "Shield ACL"?
**A:** A native Role-Based Access Control system generated for your project.

### Q: Does it use Spatie Permissions?
**A:** It can integrate with it, or use its own zero-dependency gate logic.

### Q: What is the "Multi-Tenant Shield"?
**A:** An engine that automatically scopes all data to a `team_id` or `tenant_id`.

### Q: How do I enable multi-tenancy?
**A:** Add `--tenant` to your `fabric:generate` command.

### Q: What is `fabric:guard`?
**A:** The engine that manages license gating and administrative authorization.

### Q: Does it support 2FA?
**A:** Yes, the `fabric:auth` engine includes TOTP-based 2FA.

### Q: How do I restrict a model?
**A:** Use `php artisan fabric:jail ModelName`.

### Q: Is the generated code secure?
**A:** Yes. We use standard Laravel best practices (CSRF, SQL Injection protection, etc.).

### Q: Can I customize the login view?
**A:** Yes, it's a standard Blade file in `resources/views/auth`.

### Q: Does it support social logins?
**A:** It provides stubs for Socialite integration.

### Q: How do I impersonate a user?
**A:** Fabric generates an `ImpersonationController` for admin roles.

### Q: Does it support API tokens?
**A:** Yes, it uses Laravel Sanctum by default.

### Q: Can I hide columns based on roles?
**A:** Yes, using the `@can` directive in the generated Table component.

### Q: Is the password hashing standard?
**A:** Yes, it uses the default Laravel `Hash` facade.

### Q: How do I define a "Super Admin"?
**A:** Configure the email or ID in the `fabric:guard` settings.

### Q: Does it work with Casbin?
**A:** Technically possible, but standard Gates/Policies are the default.

### Q: Can I audit every database change?
**A:** Yes, enable the `AuditTrail` component in your config.

### Q: Does it protect against N+1 queries?
**A:** Yes, the `fabric:sentry` engine identifies and helps fix them.

### Q: Are file uploads validated?
**A:** Yes, by size, type, and MIME.

### Q: How do I logout?
**A:** Standard `/logout` route generated by `fabric:auth`.

---

## 🏥 7. Troubleshooting & Maintenance

### Q: My styles aren't appearing?
**A:** Run `npm run dev` and ensure Tailwind is monitoring the `App/Livewire` folder.

### Q: `fabric:doctor` says I'm missing a package?
**A:** Run the `npm install` command provided by the doctor.

### Q: Lazarus failed to find a heal point?
**A:** Ensure you haven't deleted the `<!-- [FABRIC-HEAL] -->` comments.

### Q: Generated component has an error?
**A:** Check if the Model has the correct properties and relationships.

### Q: Migration doesn't exist?
**A:** Fabric needs the database table to exist to introspect. Run migrations first.

### Q: Livewire component not found?
**A:** Ensure you haven't renamed the class without renaming the file.

### Q: "Command not found"?
**A:** Ensure the package is installed and you are in the project root.

### Q: Themes look "broken" or "flat"?
**A:** You likely haven't added the library (e.g., Preline) to your `tailwind.config.js`.

### Q: Memory limit exceeded during forge?
**A:** For very large databases, increase your PHP memory limit or forge models one by one.

### Q: Relationships not showing?
**A:** Ensure the relationship methods (e.g., `user()`) are defined in the Model.

### Q: "File already exists" error?
**A:** Use the `--force` flag if you want to overwrite.

### Q: Audit logs are empty?
**A:** Ensure the model uses the `Auditable` trait.

### Q: Spotlight search (Ctrl+K) not working?
**A:** Ensure the `GlobalSearch` Livewire component is included in your layout.

### Q: `fabric:doctor` failed on PHP version?
**A:** Upgrade to PHP 8.3 or higher.

### Q: CSS classes aren't purging?
**A:** Check your `tailwind.config.js` content paths.

### Q: Lazarus added a field twice?
**A:** This happens if the field is present but the `wire:model` is missing. Cleanup manually.

### Q: Icons are missing?
**A:** Ensure Lucide or Heroicons are installed via NPM.

### Q: "Target class not found"?
**A:** Run `composer dump-autoload`.

### Q: Tables are slow?
**A:** Ensure you are eager-loading relationships in the `query()` method.

### Q: `fabric:context` failed?
**A:** Ensure your models don't have circular dependencies that crash the parser.

---

## 🚀 8. Deployment & Production

### Q: Should I keep Fabric in production?
**A:** It's not necessary unless you need to run `fabric:ready` or diagnostics.

### Q: Does the forged code have any overhead?
**A:** No. It's just standard Laravel code.

### Q: How do I optimize assets?
**A:** Run `npm run build`.

### Q: What is `fabric:ready`?
**A:** A final check to ensure all stubs are compiled and guards are active.

### Q: Can I use it on a shared hosting?
**A:** Yes, once the code is generated, it's just a standard Laravel app.

### Q: Does it support CI/CD?
**A:** Yes. You can run `fabric:lint` in your pipeline.

### Q: Are the forged views cached?
**A:** Standard Laravel view caching applies.

### Q: Can I forge code in production?
**A:** **NO.** This is extremely dangerous. Always forge in local/staging.

### Q: How do I handle large database migrations?
**A:** Use `fabric:reverse` to snapshot them before deployment.

### Q: Does it support Sentry/Bugsnag?
**A:** Yes, it has stubs for easy integration.

---

## 🧪 9. Customization & Stubs

### Q: Can I edit the stubs?
**A:** Yes, publish them to `resources/stubs/fabric` and edit them there.

### Q: How do I create a custom field type?
**A:** Add a new Blade fragment to the `atoms` directory in your stubs.

### Q: Can I change the generation namespace?
**A:** Yes, update `config/fabric.php`.

### Q: How do I add a new theme?
**A:** Duplicate a theme folder in stubs and register it in the config.

### Q: Can I change the default primary color?
**A:** Yes, in `config/fabric.php`.

### Q: How do I customize the Wizard?
**A:** The Wizard's steps are currently hardcoded, but you can extend the class.

### Q: Can I change the table pagination size?
**A:** Yes, in the generated Table component class.

### Q: How do I add custom buttons to the table?
**A:** Edit the `actions()` method in the generated Table class.

### Q: Can I use my own icons?
**A:** Yes, just swap the Lucide tags for your own SVG/Blade icons.

### Q: Does it support dark mode customizations?
**A:** Yes, use Tailwind's `dark:` classes.

---

## 🧠 10. AI & Neural Context

### Q: What is `fabric:context`?
**A:** It generates a structured map for LLMs (like GPT-4 or Claude) to understand your app.

### Q: How do I use the context map?
**A:** Provide the generated `fabric_context.json` to your AI coding assistant.

### Q: Does it help with AI-assisted coding?
**A:** Yes, it ensures the AI understands your unique Forge-built architecture.

### Q: What is the "Neural Context"?
**A:** The technical name for the structured project metadata.

### Q: Is it secure for AI?
**A:** It contains architecture, not user data or keys.

### Q: Can I exclude files from context?
**A:** Yes, via the `--exclude` flag.

### Q: Does it help with code explanations?
**A:** Yes, it provides the AI with "True North" for your project structure.

### Q: What is the "Nexus" in AI context?
**A:** The part of the map that defines model relationships.

### Q: Can I generate a context map for a single module?
**A:** Yes, `fabric:context --model=User`.

### Q: Does it support Mermaid diagrams?
**A:** `fabric:graph` generates Mermaid-compatible relationship maps.

---

## 🏁 11. Support & Community

### Q: Where do I report bugs?
**A:** On our official GitHub Issues page.

### Q: Is there a Discord?
**A:** We are launching a community Discord for V1.0.

### Q: How do I get enterprise support?
**A:** Contact Broadway Web Service at [clcbws.com](https://clcbws.com).

### Q: Can I request a new design library?
**A:** Yes! Open a feature request on GitHub.

### Q: Where can I see a live demo?
**A:** Visit [laravel-fabric.netlify.app](https://laravel-fabric.netlify.app/).

### Q: Is there a video tutorial?
**A:** Coming soon with the official V1.0 launch.

### Q: Who built Fabric?
**A:** The engineering team at Broadway Web Service.

### Q: How can I help?
**A:** Star us on GitHub and share your forged projects!

### Q: What's next for Fabric?
**A:** Support for Inertia.js and deeper AI integration.

### Q: Is it stable?
**A:** It's in Public Beta. Stable enough for development, but expect minor changes.

### Q: Can I hire you for custom engine work?
**A:** Yes, we specialize in high-performance Laravel engineering.

### Q: What is the "Fabric Way"?
**A:** The set of standards and best practices for using the engine.

### Q: Is there a changelog?
**A:** Yes, see `CHANGELOG.md` in the root.

### Q: Does it support Multi-Language?
**A:** Yes, all stubs use `__()` for easy localization.

### Q: Can I use it with Laravel 12?
**A:** Yes, though 13 is the target.

### Q: Is there a dark theme for the docs?
**A:** Use your browser's dark mode or the Docsify theme toggle.

### Q: How do I find a specific answer?
**A:** Use the search bar at the top of the documentation site.

### Q: "Forge and Depart" sounds too good to be true?
**A:** Try it! Generate a resource, then remove the package. You'll see it works.

### Q: What is the "Testament"?
**A:** Our naming convention for the core documentation chapters.

### Q: Is there a "Fabric for React"?
**A:** No, we are purely focused on the Laravel ecosystem.

---

> [!NOTE]
> This FAQ is updated weekly during the Public Beta. If your question isn't here, please open a GitHub Issue!
