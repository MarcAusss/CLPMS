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
        Schema::create('monitoring_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_laborer_id');
            $table->date('date_of_profiling');
            $table->date('last_monitoring_date')->nullable();
            $table->text('new_address')->nullable();
            $table->enum('currently_living_with', ['Both Parents', 'Father Only', 'Mother Only', 'Siblings', 'Others']);
            $table->enum('education_status', ['Currently Attending', 'Stopped Again', 'Never Attended']);
            $table->text('reason_for_not_attending')->nullable();
            $table->boolean('received_education_assistance');
            $table->json('health_status')->nullable();
            $table->json('family_medical_status')->nullable();
            $table->boolean('family_income_affected');
            $table->boolean('received_medical_assistance');
            $table->enum('work_status', ['Removed', 'Still Working']);
            $table->text('reason_for_continuing_work')->nullable();
            $table->json('current_work')->nullable();
            $table->json('family_livelihood_status')->nullable();
            $table->boolean('received_livelihood_assistance');
            $table->text('additional_remarks')->nullable();
            $table->string('monitored_by');
            $table->timestamp('monitored_date')->default(now());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoring_records');
    }
};
