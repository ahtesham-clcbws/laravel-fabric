# 🚀 Laravel Fabric Multi-Theme Demo Suite

Welcome to the comprehensive demo environment for **Laravel Fabric**. This suite demonstrates 100% of the scaffolding engine's capabilities across all 5 supported UI themes, integrated with the full Laravel 13 ecosystem.

---

## 🏗️ Demo Matrix

We have deployed 5 standalone Laravel apps in the `demo/` directory. Each app is a fresh installation with its own SQLite database and unique theme configuration.

| Theme | Directory | License Key | Access Link (Local) |
| :--- | :--- | :--- | :--- |
| **Tailwind** | `demo/tailwind` | `FAB-D279DF32-TEST` | `http://127.0.0.1:8000` |
| **DaisyUI** | `demo/daisyui` | `FAB-7DDFD597-TEST` | `http://127.0.0.1:8001` |
| **FloatUI** | `demo/floatui` | `FAB-F86137E2-TEST` | `http://127.0.0.1:8002` |
| **HyperUI** | `demo/hyperui` | `FAB-CC4752AB-TEST` | `http://127.0.0.1:8003` |
| **Preline** | `demo/preline` | `FAB-7C973C60-TEST` | `http://127.0.0.1:8004` |

---

## 🔐 Authentication & Data

Each demo app is pre-configured with **Laravel Breeze** and seeded with rich mock data.

- **Test User**: `test@example.com`
- **Password**: `password`
- **Database**: Each app uses its own `database/database.sqlite`.
- **Identity Engine**: These demos use the **Native Fabric Identity** (`fabric:auth`) instead of Breeze.

---

## 🛠️ The "God Model" (`CompanyResource`)

To test every single stub in the engine, we generated components for the `Admin\CompanyResource` model. This model exercises:

1.  **Field Types**: String, Text, Boolean (Toggle), Date, DateTime, JSON (Editor), Enum (Radio).
2.  **Relationships**: 
    - `BelongsTo` (Category selection with search).
    - `BelongsToMany` (Tagging UI with **Pivot Sync** logic).
3.  **Ecosystem Features**:
    - **Spatie Media Library**: Full image/file upload and preview stubs.
    - **Spatie Activity Log**: Automated audit history stubs.
    - **Soft Deletes**: Lifecycle recovery actions (Restore/Force Delete).
    - **Laravel Excel**: Built-in data export capabilities.
4.  **UI Components**:
    - Data Tables with advanced filtering and batch actions.
    - Slide-over and Modal editors.
    - Multi-series statistics widgets.

---

## 🏃 How to Run a Demo

1.  **Navigate** to a theme folder:
    ```bash
    cd demo/daisyui
    ```
2.  **Serve** the application:
    ```bash
    php artisan serve --port=8001
    ```
3.  **Login**: Visit `http://127.0.0.1:8001/login`.
4.  **Access Panel**: 
    - Table: `/companies`
    - Create: `/companies/create`

---

## 🧬 Development Infrastructure

- **`provision_demo.sh`**: Clones the `demo/template` into a theme-specific folder.
- **`finalize_demo.sh`**: Installs Breeze, publishes assets, runs migrations, seeds data, and generates the Fabric components.

---

*Happy Testing! If you find any visual inconsistencies between themes, please refer to the `stubs/` directory to refine the specific theme logic.*
