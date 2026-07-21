<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('case_studies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('service_id')->nullable()->constrained()->nullOnDelete();
            $table->string('focus_type', 20)->default('problem');
            $table->string('client');
            $table->string('duration', 50);
            $table->string('title');
            $table->text('image_path');
            $table->string('image_alt')->nullable();
            $table->string('highlight_value', 30);
            $table->string('highlight_label');
            $table->text('problem')->nullable();
            $table->text('solution')->nullable();
            $table->text('goal')->nullable();
            $table->text('actions_taken')->nullable();
            $table->json('stack')->nullable();
            $table->json('results')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();

            $table->index(['is_published', 'sort_order']);
            $table->index('service_id');
            $table->index('focus_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('case_studies');
    }
};
