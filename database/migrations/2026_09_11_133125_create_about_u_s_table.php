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
        Schema::create('about_u_s', function (Blueprint $table) {
            $table->id();
            $table->json('hero_section')->nullable();
            $table->json("about_company")->nullable();
            $table->json('mission_vision')->nullable();
            $table->json("ceo_message")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_u_s');
    }
};
