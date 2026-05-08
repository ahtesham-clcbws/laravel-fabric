# 🤖 AI Context: Agentic Developer Experience

Laravel Fabric is built for the age of AI. The `fabric:context` command generates a comprehensive structural map of your application, designed specifically to be consumed by LLMs (Large Language Models) like Claude or GPT-4.

## Bridging the Gap

When you are pair-programming with an AI assistant, it needs to understand your database schema, relationships, and custom logic.

`php artisan fabric:context` produces a markdown file (`.fabric-context.md`) that includes:
- **Schema Blueprint**: Every table, column type, and index.
- **Relationship Map**: How models are connected (BelongsTo, HasMany, etc.).
- **Livewire Registry**: A list of all forged components and their locations.
- **Routing Table**: All administrative entry points.

## Why it Matters

By providing this context to your AI agent, you enable:
- **Accurate Code Completion**: The AI knows exactly what fields are available in your models.
- **Complex Refactoring**: The AI understands how a change in one table affects the rest of the application.
- **Bug Discovery**: The AI can spot relationship mismatches or missing validation rules.

---

> [!NOTE]
> The generated context file is optimized for token efficiency, ensuring you don't waste your LLM's context window on irrelevant files.
