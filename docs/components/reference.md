# 🧩 Testament V: Component Lexicon

Fabric ships with over **160+ atomic components**. These are published to your project during the scaffolding process or can be used manually via the `<x-fabric::...>` namespace.

## 1. Core Inputs
The foundation of every CRUD view.

- **`<x-fabric::input>`**: Standard text input with floating label support.
- **`<x-fabric::textarea>`**: Auto-expanding text area.
- **`<x-fabric::select>`**: Semantic select dropdown.
- **`<x-fabric::checkbox>`**: Toggle-ready checkbox.
- **`<x-fabric::radio-group>`**: Vertical or horizontal radio options.

## 2. Advanced Form Fields (Preline & HyperUI)
Specialized inputs for high-end applications.

- **`<x-fabric::pin-input>`**: Interactive OTP/security code fields.
- **`<x-fabric::quantity-input>`**: Interactive +/- numeric controls.
- **`<x-fabric::tags-input>`**: Pill-based tag management.
- **`<x-fabric::file-uploader>`**: Drag-and-drop file interface.

## 3. Feedback & Overlays
Keeping users informed and focused.

- **`<x-fabric::alert>`**: Semantic notifications (Success, Info, Error).
- **`<x-fabric::modal>`**: High-fidelity overlays with focus trapping.
- **`<x-fabric::toast>`**: Stackable, timed notifications.
- **`<x-fabric::skeleton>`**: Loading placeholders for smooth UX.

## 4. Navigation & Structure
Defining the architecture of your views.

- **`<x-fabric::stepper>`**: Multi-stage progress tracking.
- **`<x-fabric::timeline>`**: Chronological event logs.
- **`<x-fabric::accordion>`**: Collapsible content sections.
- **`<x-fabric::tabs>`**: Tabbed navigation with mobile-select fallback.

---
[Next: The Palette Engine →](./../design-systems/palettes.md)
