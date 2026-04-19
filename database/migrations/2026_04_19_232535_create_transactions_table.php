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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('stock_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('type', 20);

            $table->decimal('quantity', 18, 6)->nullable();
            $table->decimal('price', 18, 6)->nullable();
            $table->decimal('fee', 18, 6)->default(0);

            $table->string('currency', 10)->default('USD');

            $table->timestamp('executed_at')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index(['user_id', 'stock_id']);
            $table->index('executed_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
