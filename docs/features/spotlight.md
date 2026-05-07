# 🔦 Global Spotlight (Native Search)

Fabric's Global Spotlight is a high-speed, zero-dependency command palette that centralizes navigation and search across your entire forged ecosystem.

## 🚀 How it Works
Press `Ctrl+K` (or `Cmd+K` on Mac) from any page in the Fabric-forged admin panel.

## ✨ Features:
- **Instant Search**: Searches across all models registered in your `SearchRegistry`.
- **Command Palette**: Quick actions like "Go to Dashboard," "Logout," or "Create New Product."
- **Keyboard-First**: Navigate results entirely with arrow keys and Enter.
- **Unified Results**: See "Users," "Orders," and "Products" in a single, beautiful bento-grid dropdown.

## 🛡️ Performance
Uses a high-performance `UNION` query strategy for database-driven searches, ensuring sub-100ms response times without needing external indices like Algolia.
