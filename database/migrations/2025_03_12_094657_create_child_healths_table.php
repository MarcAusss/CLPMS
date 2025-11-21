<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('child_healths', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_laborer_id')->constrained('child_laborers')->onDelete('cascade');
            
            // Health Measurements
            $table->float('height_cm');
            $table->float('weight_kg');
            
            // Disability Information
            $table->boolean('has_disability')->default(false);
            $table->json('specific_disability')->nullable();
            $table->string('specific_disability_other')->nullable();
            
            // Child Ailments
            $table->json('child_ailments')->nullable();
            $table->string('skin_disease_specify')->nullable();
            $table->string('allergies_specify')->nullable();
            $table->string('other_ailments_specify')->nullable();
            
            // Medical Assessment
            $table->boolean('medical_assessment')->default(false)->nullable();
            
            // Family Medical History
            $table->json('family_medical_history')->nullable();
            $table->string('family_other_specify')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('child_healths');
    }
};