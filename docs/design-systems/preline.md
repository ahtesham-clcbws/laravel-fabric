# 🏢 Preline UI (Enterprise)

Preline UI is an open-source set of prebuilt UI components based on the utility-first Tailwind CSS framework. Fabric has deconstructed Preline into atomic, forgeable building blocks.

## 🧵 Forging Preline
To forge a Preline component, use the following command structure:

```bash
php artisan fabric:component preline:{section}
```

## 💎 Smart Components (Atoms)
These are high-fidelity, prop-driven components that adhere to the Fabric Design System.

- `button` (Supports solid, soft, outline, ghost)
- `input` (High-fidelity, validation-ready)
- `alert` (Semantic variants)
- `badge`
- `modal`
- `dropdown`
- `tabs`
- `accordion`

## 🧱 Sections & Examples
Fabric provides over 250+ individual sections from Preline, including:

- `hero-section`
- `features-section`
- `pricing-section`
- `contact-section`
- `faq-section`
- `footer-section`

## 🖥️ Layouts
- `sidebar-layout`
- `top-nav-layout`
- `bento-layout`

---

> [!TIP]
> Use `php artisan fabric:list preline` to see the full, real-time list of available sections for this library.
