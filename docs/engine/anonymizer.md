# 🛡️ The Data-Anonymizer (Native Compliance)

Fabric's "Data-Anonymizer" is an enterprise-grade utility that ensures your development environments are 100% secure and GDPR-compliant.

## 🚀 How it Works
Run the command:
```bash
php artisan fabric:anon
```

The engine introspects your models and identifies sensitive columns using Fabric's "Privacy Registry."

## 🔒 What it Scrubs:
- **Names**: Replaced with realistic random names.
- **Emails**: Replaced with `user_{id}@example.com`.
- **Phones**: Replaced with randomized valid formats.
- **Addresses**: Replaced with generic city/country data.
- **Passwords**: Re-hashed with a generic development password.

## 🧪 Use Case
Perfect for:
1.  **Onboarding**: Giving new developers a "Safe" copy of the DB.
2.  **Staging**: Testing with realistic data volumes without risking real user data.
3.  **Local Dev**: Avoiding accidental emails to real users during local testing.
