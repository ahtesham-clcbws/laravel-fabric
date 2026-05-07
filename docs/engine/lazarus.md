# 🧬 The Lazarus Engine (Surgical Patching)

One of the biggest pain points in scaffolding is **schema drift**. When you add a new column to your database, you typically have to manually update your views or re-generate them and lose your custom code.

**Lazarus solves this.**

## 🩺 How it Works
The Lazarus engine (`fabric:heal`) performs a **Reverse-Introspection Audit**:
1.  It scans the database for the current state of the model.
2.  It parses your existing Blade files (Editor and Table).
3.  It identifies missing fields that exist in the DB but not in the code.
4.  It surgically injects the new field stubs into your files.

## 🔨 Usage
```bash
php artisan fabric:heal User
```

## 🛡️ Safety First
Lazarus uses **Heal Points** (HTML comments) to know where to insert code. If it doesn't find a heal point, it will attempt to inject before the closing tags (like `</form>` or `</tr>`).

> [!TIP]
> Always keep the `<!-- [FABRIC-HEAL-FORM] -->` comment in your editor files to ensure the engine knows where to place new fields.

## ✨ Features
- **Intelligent Injection**: Detects if a field is already present via `wire:model` analysis.
- **Theme Awareness**: Injects fields using the design system of your existing component.
- **Custom Code Preservation**: Never overwrites your existing logic—only adds what is missing.
