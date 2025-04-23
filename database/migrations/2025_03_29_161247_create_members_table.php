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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique()->nullable();
            $table->string('phone');
            $table->string('emergency_contact_number')->nullable();
            $table->enum('gender', ['male', 'female', 'other']);
            $table->date('date_of_birth')->nullable();
            $table->text('address');
            $table->date('registration_date');
            $table->enum('status', ['active', 'inactive', 'expired'])->default('active');
            $table->text('medical_conditions')->nullable();
            $table->boolean('need_trainer')->default(0);          
            $table->foreignId('trainer_id')->nullable()->constrained('trainers')->onDelete('set null');
            $table->json('service_ids'); // e.g., [1, 2, 3]
            $table->string('plan'); // e.g., monthly, yearly, one-time
            $table->decimal('fee', 10, 2);   // Plan base fee
            $table->string('profile_photo')->nullable();
            $table->timestamps();

            $table->index('first_name');
            $table->index('last_name');
            $table->index('phone');
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
