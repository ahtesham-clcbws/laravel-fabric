# 🤖 The AI-Context Export (Perfect Prompting)

Fabric's AI-Context engine is a forward-thinking tool designed for the modern developer who pairs with AI to build the future.

## 🚀 How it Works
Run the command:
```bash
php artisan fabric:context
```

The engine uses the Loom introspector to generate a single, dense, text-optimized file containing your entire application's "Cognitive Map."

## 🧠 What it Includes:
- **Model Registry**: Every model and its fillable/guarded attributes.
- **Relationship Map**: A literal "Who-owns-Who" of your database.
- **Trait Audit**: Which models are using Auditable, HasFiles, or HasRoles.
- **API Map**: All active endpoints and their corresponding resources.
- **Validation Rules**: The core business logic for every record.

## 🧪 Use Case
Paste this file into your AI assistant (Claude, Gemini, GPT) and say: *"I am working on this Laravel Fabric project. Based on the attached context, write me a new service for..."*
The AI will have 100% accurate knowledge of your architecture, eliminating hallucinations and "context drift."
