<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('changelog_entries', function (Blueprint $table) {
            $table->id();
            $table->string('version', 20);
            $table->date('released_at');
            $table->string('type', 20);
            $table->string('title');
            $table->text('description');
            $table->string('author_name');
            $table->timestamps();

            $table->index(['released_at', 'version']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('changelog_entries');
    }
};
