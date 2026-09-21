<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {

            $table->id();

            $table->foreignId('orderitem_id')
                ->constrained('order_items')
                ->cascadeOnDelete();

            $table->string('transaction_id')
                ->nullable()
                ->unique();

            $table->string('payment_method');

            $table->decimal('amount', 10, 2);

            $table->enum('status', [
                'pending',
                'processing',
                'paid',
                'failed',
                'refunded'
            ])->default('pending');

            $table->string('currency', 10)->default('INR');

            $table->string('gateway')->nullable();

            $table->string('gateway_payment_id')->nullable();

            $table->text('failure_reason')->nullable();

            $table->timestamp('paid_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
