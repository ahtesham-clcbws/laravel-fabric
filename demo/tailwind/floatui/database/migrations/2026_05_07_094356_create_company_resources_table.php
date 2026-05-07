<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('company_resources', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('email')->nullable();
            $table->boolean('active')->default(true);
            $table->date('founded_at')->nullable();
            $table->datetime('last_audit_at')->nullable();
            $table->json('settings')->nullable();
            $table->string('type')->default('startup'); // Map to CompanyType Enum
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_resources');
    }
};
