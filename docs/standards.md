# Laravel Fabric: Development Standards

To ensure consistency and maintainability across all projects forged with Fabric, the following standards must be strictly followed.

## 🧱 Component Architecture
**Strict Rule**: Every Livewire and Blade component MUST be created with separate class and view files. 
- **NO Single-File Components**: Avoid using Volt or any "lightning" style single-file components.
- **Modular Website Parts**: Large reusable parts of the website (e.g., Footer, Navigation) must be extracted into their own dedicated components under `App\View\Components\Website`.

## 🎨 UI & Aesthetics
- **DaisyUI Integration**: Use curated DaisyUI themes for all forged resources.
- **Responsiveness**: All components must be mobile-first and tested for high-density administrative views.
- **Interactivity**: Use hover-effects and micro-animations to enhance user engagement.

## 🖼️ Asset Management
**Strict Rule**: All images and media MUST be stored locally within the project's `public/assets/` directory.
- **NO External URLs**: Do not use Unsplash, Picsum, or any other third-party image hosting in production-ready demos.
- **Paths**: Use the `asset()` helper to link to images (e.g., `{{ asset('assets/images/hero.png') }}`).

## 🛠️ CLI Workflow
- **fabric:generate**: Use this for all resource CRUD generation.
- **fabric:settings**: Use this for all global configuration management.
- **fabric:component**: Use this for extracting high-fidelity UI sections from framework libraries.

## 🛡️ Data Governance
- **Audit Logging**: Always enable activity logging for critical resources.
- **Soft Deletes**: Use soft deletes for all user-facing data to prevent accidental loss.
- **Impersonation**: Enable impersonation for support roles to troubleshoot user issues effectively.
