# 🗝️ API-Key Management (Native Tokens)

Fabric's Native API Key system provides a lightweight, zero-dependency way to grant programmatic access to your forged resources.

## 🚀 How it Works
Run the Auth Forge to include the Token Management UI in your Profile:
```bash
php artisan fabric:auth --tokens
```

## ✨ Features:
- **Instant Generation**: Create secure, 64-character tokens instantly.
- **Ability Mapping**: (Coming in v1.1) Assign "Read-Only" or "Full-Access" to tokens.
- **One-Click Revoke**: Instantly kill any compromised or old keys.
- **Native Guard**: Uses a simple `fabric:api` middleware to verify tokens via a hashed database check—no heavy Sanctum setup required.

## 🛡️ Security
Tokens are stored using high-fidelity **SHA-256 Hashing**, ensuring that even if your database is compromised, the actual keys remain secure.
