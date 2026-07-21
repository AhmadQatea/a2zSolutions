<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('icon')->nullable();
            $table->string('icon_variant', 20)->default('navy');
            $table->string('title');
            $table->text('description');
            $table->text('long_description')->nullable();
            $table->string('layout', 20)->nullable();
            $table->string('decor_icon')->nullable();
            $table->string('link_label')->nullable();
            $table->string('href')->nullable();
            $table->json('features')->nullable();
            $table->text('image_path')->nullable();
            $table->string('image_alt')->nullable();
            $table->unsignedInteger('base_price')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->boolean('show_on_home')->default(false);
            $table->boolean('show_on_services_page')->default(true);
            $table->timestamps();

            $table->index(['is_published', 'sort_order']);
            $table->index('show_on_home');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
