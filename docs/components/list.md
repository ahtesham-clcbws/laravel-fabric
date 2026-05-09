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
- **Views**: Dashboard, Editor, Lab, Settings, Show, Stats, Table, Welcome.

---

## ⚡ Preline UI Framework
*Location: `stubs/livewire/preline`*
- **Layouts**: Bento, Minimalist, Sidebar, Top-Nav.
- **Components**:
  - `advanced-select`, `alert`, `avatar-group`, `input-group`
  - `modal`, `pin-input`, `progress`, `stepper`, `switch`, `timeline`
- **Views**: Editor, Stats, Table.

---

## 💎 HyperUI Product Design
*Location: `stubs/livewire/hyperui`*
- **Layouts**: Sidebar, Top-Nav.
- **Components**:
  - `accordion`, `badge`, `breadcrumbs`, `empty-state`
  - `file-uploader`, `input`, `quantity-input`, `select`
  - `steps`, `tabs`, `timeline`
- **Views**: Editor, Stats, Table.

---

## 🌊 Float UI Minimalist Design
*Location: `stubs/livewire/floatui`*
- **Layouts**: Minimalist, Sidebar, Top-Nav.
- **Components**:
  - `alert`, `hero-section`, `modal`, `pagination`
- **Views**: Editor, Stats, Table.

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
