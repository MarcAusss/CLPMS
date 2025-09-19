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
        Schema::create('child_work', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_laborer_id');
            $table->enum('nature_of_work', ['Mining', 'Quarrying', 'Construction', 'Transportation', 'Fishing', 'Farming', 'Domestic', 'Manufacturing', 'Others']);
            $table->json('specific_tasks');
            $table->string('employer_name')->nullable();
            $table->string('employer_contact')->nullable();
            $table->text('employer_address')->nullable();
            $table->enum('work_arrangement', ['Paid Worker', 'Unpaid Worker', 'Self-Employed', 'Others']);
            $table->integer('working_hours_per_day');
            $table->integer('working_days_per_week');
            $table->time('work_start_time')->nullable();
            $table->time('work_end_time')->nullable();
            $table->integer('age_started_working');
            $table->json('exposure_risks');
            $table->json('payment_basis');
            $table->decimal('average_monthly_income', 10, 2)->nullable();
            $table->json('earnings_usage');
            $table->boolean('has_adult_supervisor');
            $table->string('supervisor_name')->nullable();
            $table->enum('supervisor_relationship', ['Parent/Guardian', 'Elder Sibling', 'Employer', 'Others']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_works');
    }
};
