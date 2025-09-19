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
        Schema::create('child_health', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_laborer_id');
            $table->boolean('has_disability');
            $table->json('disability_types')->nullable();
            $table->boolean('requires_disability_assessment');
            $table->float('height_cm')->nullable();
            $table->float('weight_kg')->nullable();
            $table->json('recent_ailments')->nullable();
            $table->boolean('requires_medical_assessment');
            $table->json('family_medical_history')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_healths');
    }
};
