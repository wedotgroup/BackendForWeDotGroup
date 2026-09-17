<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('top_highlights')->nullable();
            $table->string('title');
            $table->string('rating')->default(0);
            $table->string('rating_text')->nullable();

            $table->string('currency_code')->default('INR');
            $table->string('price')->nullable();
            $table->string('stock_price')->nullable();

            $table->text('description')->nullable();

            $table->json('package_includes')->nullable();
            $table->string('images')->nullable();

            $table->string('category')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
