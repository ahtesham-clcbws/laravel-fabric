# 📋 Exhaustive Component List

Fabric provides a vast library of **149 high-fidelity stubs** across multiple design frameworks. This list serves as a reference for all available components you can extract or use in your project.

## 🛠️ Common & Core Components
*Location: `stubs/livewire/common`*
- **AuditTrail.php**: Activity logging backend.
- **Breadcrumbs.php**: Dynamic breadcrumb generator.
- **Dashboard.php**: Administrative landing page logic.
- **Editor.php**: Form handling and resource editing.
- **GlobalSearch.php**: Spotlight search backend.
- **Health.php**: System diagnostic component.
- **Lab.php**: Experimental UI playground.
- **Omnisearch.php**: Universal search interface.
- **Settings.php**: Configuration management.
- **Show.php**: Resource detail view.
- **Stats.php**: Data visualization backend.
- **Table.php**: High-performance data table.
- **Auth (Login, Profile, Register)**: Identity management suite.

---

## 🌼 DaisyUI Ecosystem
*Location: `stubs/livewire/daisyui`*
- **Layouts**: Bento, Guest, Minimalist, Sidebar, Top-Nav, Web, Web-Blog.
- **Components**:
  - `button`, `cards`, `contact`, `drawer-editor`, `faq`
  - `gallery`, `hero`, `input`, `navbar-mega`, `omnisearch`
  - `order-history`, `pricing`, `select`, `slider`, `stat-ring`
  - `stats-v2`, `tall-input`, `testimonials`, `textarea`, `timeline`
  - `toggle`, `usage-metrics`
## ⚡ Preline UI Framework (Absolute 100% Master Harvest)
*Location: `stubs/livewire/preline`*
- **Layouts**: `sidebar`, `bento`, `minimalist`, `top-nav`, `application-layouts`
- **Pages**: `application-page-admin`, `page-pricing`, `invoice`, `user-profiles`, `settings-page`
- **Marketing**: `hero-sections`, `hero-forms`, `icon-sections`, `pricing-sections`, `blog-sections`, `blog-articles`, `faq-sections`, `features-sections`, `contact-sections`, `clients-sections`, `galleries`, `card-sections`, `announcement-banners`, `stats-sections`, `team-sections`, `masonry-sections`
- **Components**: `accordion`, `advanced-select`, `ai-prompt`, `alert`, `avatars`, `badges`, `blockquotes`, `breadcrumbs`, `button-groups`, `buttons`, `cards`, `carousel`, `charts`, `chat-bubbles`, `combobox`, `context-menu`, `cookie-banners`, `copy-markup`, `data-table`, `description-lists`, `devices`, `dropdowns`, `inputs`, `legend-indicators`, `list-group`, `lists`, `mega-menu`, `modals`, `navigations`, `offcanvas`, `pagination`, `pin-input`, `popover`, `product-card`, `product-listings`, `progress`, `ratings`, `scrollspy`, `searchbox`, `selection-controls`, `skeletons`, `sliders-pickers`, `spinners`, `steppers`, `strong-password`, `tabs`, `timeline`, `toasts`, `toggle-count`, `toggle-password`, `tooltip`, `tree-view`
- **Authentication**: `login`, `register`

---

## 🌼 DaisyUI (100% Exhaustion - Core Tailwind + Alpine)
*Location: `stubs/livewire/daisyui`*
- **Items**: `accordion`, `alert`, `avatar`, `badge`, `breadcrumbs`, `button`, `calendar`, `card`, `cards`, `carousel`, `chat-bubble`, `checkbox`, `collapse`, `contact`, `countdown`, `diff`, `divider`, `dock`, `drawer`, `drawer-editor`, `dropdown`, `fab`, `faq`, `fieldset`, `file-input`, `filter`, `footer`, `gallery`, `hero`, `hover-3d`, `hover-gallery`, `indicator`, `input`, `join`, `kbd`, `label`, `link`, `list`, `loading`, `mask`, `menu`, `mockup-browser`, `mockup-code`, `mockup-phone`, `mockup-window`, `modal`, `navbar`, `navbar-mega`, `omnisearch`, `order-history`, `pagination`, `pricing`, `progress`, `radial-progress`, `radio`, `range`, `rating`, `select`, `skeleton`, `slider`, `stack`, `stat`, `stat-ring`, `status`, `stats-v2`, `steps`, `swap`, `tab`, `table`, `tall-input`, `testimonials`, `text-rotate`, `textarea`, `theme-controller`, `timeline`, `toast`, `toggle`, `tooltip`, `usage-metrics`, `validator`

---

## 🖤 Shadcn UI (Aesthetic Translation - Core Tailwind + Alpine)
*Location: `stubs/livewire/shadcn`*
- **Items**: `accordion`, `alert`, `alert-dialog`, `aspect-ratio`, `avatar`, `badge`, `breadcrumb`, `button`, `calendar`, `card`, `carousel`, `checkbox`, `collapsible`, `combobox`, `command`, `context-menu`, `data-table`, `date-picker`, `dialog`, `drawer`, `dropdown-menu`, `form`, `hover-card`, `input`, `input-otp`, `label`, `menubar`, `navigation-menu`, `pagination`, `popover`, `progress`, `radio-group`, `resizable`, `scroll-area`, `select`, `separator`, `sheet`, `skeleton`, `slider`, `sonner`, `switch`, `table`, `tabs`, `textarea`, `toast`, `toggle`, `toggle-group`, `tooltip`

---

## 🧱 Tailgrids UI
*Location: `stubs/livewire/tailgrids`*
- **Sections**: `cart-sections`, `checkout-forms`, `ecommerce-sections`, `marketing-sections`, `product-listings`

---

## 💎 Meraki UI
*Location: `stubs/livewire/merakiui`*
- **Marketing**: `contact-sections`, `feature-sections`, `hero-sections`

---

## 🎨 Tailwind UI (Standard)
*Location: `stubs/livewire/tailwind`*
- **Atoms**: `accordion`, `alert`, `avatar`, `badge`, `breadcrumbs`, `button`, `card`, `card-image`, `carousel`, `checkbox`, `drawer`, `dropdown`, `input`, `modal`, `popover`, `progress`, `rating`, `select`, `stat-card`, `steps`, `tags-input`, `textarea`, `toast`, `toast-container`, `toggle`, `tooltip`

---

## 🌊 Hyper UI & FloatUI
*Location: `stubs/livewire/hyperui` | `stubs/livewire/floatui`*
- **Curated**: `accordion`, `badge`, `banner`, `blog-card`, `breadcrumbs`, `cart`, `details-list`, `empty-state`, `file-uploader`, `input`, `quantity-input`, `select`, `steps`, `tabs`, `timeline`
- **Marketing**: `alert`, `contact-section`, `feature-section`, `hero-section`, `modal`, `newsletter`, `pagination`, `pricing-section`

---

## 📘 Tailwind Standard (Utility)
*Location: `stubs/livewire/tailwind`*
- **Layouts**: Bento, Double-Sidebar, Guest, Minimalist, Sidebar, Top-Nav.
- **Components**:
  - `accordion`, `alert`, `avatar`, `badge`, `breadcrumbs`, `button`
  - `card`, `card-image`, `carousel`, `checkbox`, `drawer`, `dropdown`
  - `header-page`, `input`, `modal`, `popover`, `progress`, `rating`
  - `select`, `stat-card`, `steps`, `tags-input`, `textarea`
  - `toast`, `toast-container`, `toggle`, `tooltip`
- **Views**: Dashboard, Editor, Show, Stats, Table.

---

### 🚀 Usage
You can extract any of these components using the CLI:
```bash
php artisan fabric:component {framework}:{component}
```
Example: `php artisan fabric:component daisyui:hero`
