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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_code', 50)->unique();

            $table->string('first_name');
            $table->string('last_name')->nullable();

            $table->string('email')->nullable()->unique();
            $table->string('phone', 30)->nullable();

            $table->date('date_of_birth')->nullable();
            $table->string('gender', 20)->nullable();

            $table->date('date_of_joining');

            $table->foreignId('department_id')
                ->nullable();

            $table->foreignId('designation_id')
                ->nullable();

            $table->foreignId('manager_id')
                ->nullable()
                ->constrained('employees')
                ->nullOnDelete();

            $table->string('employment_type', 30)
                ->default('full_time');

            $table->string('status', 30)
                ->default('active');

            $table->text('address')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('pincode', 20)->nullable();

            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone', 30)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
