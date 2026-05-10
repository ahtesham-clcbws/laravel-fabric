# 📋 The Library Lexicon (Exhaustive List)

Fabric provides a vast ecosystem of over **500+ forgeable blocks** categorized into Smart Atoms, Marketing Sections, and Page Layouts.

---

## 💎 Smart Atoms (Components)
*Extract using: `php artisan fabric:component {library}:{atom}`*

### 📥 Inputs & Controls
- `input` (Standard text input)
- `textarea` (Auto-expanding text area)
- `select` (Semantic dropdown)
- `checkbox` / `toggle` (Binary choice)
- `radio-group` (Enum-based selection)
- `pin-input` (OTP / Security code fields)
- `file-uploader` (Drag-and-drop media)
- `quantity-input` (Numerical controls)
- `combobox` (Searchable select)

### 🔘 Buttons & Actions
- `button` (Solid, Soft, Outline, Ghost)
- `button-group` (Segmented actions)
- `dropdown` (Contextual menus)
- `copy-markup` (Copy-to-clipboard)

### 📟 Feedback & Overlays
- `alert` (Success, Error, Info, Warning)
- `modal` / `dialog` (Fluid overlays)
- `toast` / `sonner` (Notifications)
- `skeleton` (Loading placeholders)
- `progress` / `radial-progress` (Visual metrics)
- `badge` (Status indicators)
- `tooltip` (Hover hints)

---

## 🧱 Marketing & Functional Sections (Examples)
*Extract using: `php artisan fabric:component {library}:{section}`*

### 🚀 Heroes & Landing
- `hero-section` (Split, Centered, Form-heavy)
- `feature-section` (Grid, List, Iconic)
- `stats-section` (Metrics & KPI grids)
- `newsletter-section` (Subscription forms)

### 📦 Content & Lists
- `blog-section` / `blog-articles` (Editorial grids)
- `team-section` (Member profiles)
- `faq-section` (Accordion-based support)
- `testimonial-section` (Client social proof)
- `client-section` (Logo clouds)
- `gallery-section` (Masonry & Grids)
- `timeline` (Chronological history)
- `pricing-section` (Tiered subscription cards)

---

## 🖥️ Page Layouts (Blueprints)
*Extract using: `php artisan fabric:component {library}:{layout}-layout`*

- `sidebar-layout` (Enterprise vertical nav)
- `top-nav-layout` (SaaS horizontal nav)
- `bento-layout` (Modern grid geometry)
- `minimalist-layout` (Lean content focus)
- `guest-layout` (Clean authentication focus)
- `web-layout` (Full marketing frontend)
- `web-blog-layout` (Content-first publishing)

---

## 🛠️ Global Common Components
*Location: `stubs/livewire/common`*

- `Table.php`: High-performance relational data grid.
- `Editor.php`: Intelligent form handling and resource editing.
- `Show.php`: High-fidelity resource detail view.
- `Stats.php`: Data visualization and KPI dashboard.
- `Dashboard.php`: Central administrative landing page.
- `Spotlight.php`: Global command palette backend.
- `Auth/`: Full suite for Login, Register, and Profile management.

---

> [!TIP]
> Use the **`php artisan fabric:lexicon`** command in your terminal to explore this list interactively with real-time library filtering.
