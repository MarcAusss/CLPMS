<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('child_laborers', function (Blueprint $table) {
            $table->id();
            
            // Personal Information
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('suffix')->nullable();
            $table->enum('sex', ['Male', 'Female']);
            $table->date('date_of_birth');
            $table->integer('age');
            $table->boolean('birth_certificate');
            
            // Address
            $table->string('address_region');
            $table->string('address_province');
            $table->string('address_city');
            $table->string('address_barangay');
            $table->string('address_sitio')->nullable();
            
            // Place of Birth - stores the full text
            $table->text('place_of_birth')->nullable();
            
            // Cultural Background
            $table->string('religion');
            $table->string('religion_other')->nullable(); // FIXED: Made nullable
            $table->enum('indigenous_group', ['Yes', 'No']); // FIXED: Changed to ENUM
            $table->string('indigenous_group_spec')->nullable();
            
            // Living Situation
            $table->enum('living_with', ['Both Parents', 'Father Only', 'Mother Only', 'Relatives', 'Non-Relatives', 'Living Alone']);
            $table->enum('dwelling_type', ['Strong Materials', 'Light Materials', 'Makeshift', 'Mixed Strong', 'Mixed Light', 'Mixed Salvaged', 'No Permanent Dwelling']);
            $table->string('contact_number')->nullable();
            
            // 4Ps Information - ADDED
            $table->enum('is_4ps_member', ['Yes', 'No'])->nullable();
            $table->string('house_id_number')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('child_laborers');
    }
};