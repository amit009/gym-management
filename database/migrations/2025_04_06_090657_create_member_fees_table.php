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
        Schema::create('member_fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()->onDelete('cascade');          
            
            $table->decimal('original_amount', 10, 2);   // Plan base fee
            $table->decimal('discount_amount', 10, 2)->default(0.00);
            $table->decimal('final_amount', 10, 2);      // Final after discount

            $table->enum('payment_status', ['paid', 'unpaid', 'partial'])->default('unpaid');
            $table->date('payment_date')->nullable();
            $table->string('payment_method')->nullable(); // e.g., cash, card, UPI
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_fees');
    }
};
