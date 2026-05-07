<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tags', function (Blueprint $row) {
            $row->id();
            $row->string('name');
            $row->string('slug');
            $row->timestamps();
        });

        Schema::create('company_resource_tag', function (Blueprint $row) {
            $row->id();
            $row->foreignId('company_resource_id')->constrained()->cascadeOnDelete();
            $row->foreignId('tag_id')->constrained()->cascadeOnDelete();
            $row->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_resource_tag');
        Schema::dropIfExists('tags');
    }
};
