<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hero_sections', function (Blueprint $table) {
            $table->id();
            $table->json('badges')->nullable();
            $table->string('hero_title')->nullable();
            $table->string('hero_heading')->nullable();
            $table->longText('description')->nullable();
            $table->string('button_one')->nullable();
            $table->string('link_one')->nullable();
            $table->string('button_two')->nullable();
            $table->string('link_two')->nullable();
            $table->json('extra_lists')->nullable();
            $table->json('list_items')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_sections');
    }
};
