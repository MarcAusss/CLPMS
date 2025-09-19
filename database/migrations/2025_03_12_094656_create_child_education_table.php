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
        Schema::create('child_education', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_laborer_id');
            $table->boolean('has_gone_to_school');
            $table->boolean('currently_attending');
            $table->string('learner_reference_no')->nullable();
            $table->string('highest_grade_completed');
            $table->enum('mode_of_education', ['Formal', 'Non-formal']);
            $table->integer('age_stopped_schooling')->nullable();
            $table->json('reason_for_stopping')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_education');
    }
};
