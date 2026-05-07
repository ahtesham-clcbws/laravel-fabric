# The Component Lexicon
## Testament V: Atomic Stubs

Fabric is built on a foundation of **160+ Atomic Stubs**. These are small, modular fragments of Blade and PHP that the Loom weaves together to create your UI.

### 🧩 Core Atom Categories

#### 1. Input Atoms (`x-fabric::input`)
- **Text**: Standard text input with focus rings and label support.
- **Number**: Type-restricted input with step increments.
- **Email/Password**: Specialized types for credential handling.
- **Readonly**: Disabled inputs for auto-generated fields (like Slugs).

#### 2. Selection Atoms (`x-fabric::select`)
- **Standard Select**: Pure HTML select for small lists.
- **Searchable Select**: Relationship-aware component for searching thousands of records.
- **Radio Group**: Semantic choice atoms used for PHP Enums.

#### 3. Data Atoms (`x-fabric::table`)
- **Cell**: Content atoms for text, dates, and numbers.
- **Status Badge**: Auto-colorizing badges for Enums or Booleans.
- **Thumbnail**: Small image previews for Spatie Media fields.

#### 4. Action Atoms
- **Primary Button**: High-visibility action for 'Add' or 'Save'.
- **Danger Button**: Red-tinted atoms for 'Delete'.
- **Ghost Button**: Subtle actions for 'Cancel' or 'View'.

---

### 🎨 Design System Variations

Each atom exists in **5 distinct visual souls**:

1. **Tailwind (Classic)**: Clean, professional, and familiar.
2. **DaisyUI (Vibrant)**: Fun, colorful, and component-heavy.
3. **Preline (Enterprise)**: Heavy-duty SaaS components.
4. **Float UI (Minimal)**: Spaced-out, modern, and high-contrast.
5. **HyperUI (Creative)**: Unique layouts for creative projects.

---

### 🛠️ Using Atoms Manually

While Fabric forges these for you, you can use them manually in any Blade file:

```blade
<x-fabric::input label="Username" wire:model="username" />
<x-fabric::select label="Role" wire:model="role_id">
    <option value="admin">Admin</option>
</x-fabric::select>
```

### 🏁 Final Thought
**"The Lexicon is the periodic table of your UI. Use it to build anything."**
