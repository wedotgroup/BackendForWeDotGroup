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
        Schema::create('manage_itcnslts', function (Blueprint $table) {
            $table->id();
            $table->string('first_heading')->nullable();
            $table->longText('small_paragraph')->nullable();
            $table->string("button1_text")->nullable();
            $table->string("button2_text")->nullable();
            $table->string('hero_image')->nullable();
            $table->string('heading')->nullable();
            $table->longText("description")->nullable();
            $table->json('services')->nullable();
            $table->string('button3_text')->nullable();
            $table->json("our_services")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manage_itcnslts');
    }
};
