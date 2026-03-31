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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->text('job_title');
            $table->text('department')->nullable();
            $table->text('location')->default('Remote');
            $table->string('work_type')->default('Remote');
            $table->string('employment_type')->default('Full-time');
            $table->string('experience_level')->default('Junior');
            $table->decimal('min_salary', 15, 2)->nullable();
            $table->decimal('max_salary', 15, 2)->nullable();
            $table->string('currency')->default('USD');
            $table->string('hiring_urgency')->default('Normal');
            $table->text('job_description');
            $table->json('required_skills')->nullable();
            $table->text('application_link')->nullable();
            $table->enum('status', ['active', 'closed'])->default('active');
            $table->date('closing_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
