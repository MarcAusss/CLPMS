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
        Schema::create('child_laborers', function (Blueprint $table) {
            $table->id();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('suffix')->nullable();
            $table->enum('sex', ['Male', 'Female']);
            $table->date('date_of_birth');
            $table->string('dob_actual');
            $table->integer('age');
            $table->boolean('birth_certificate');
            $table->text('place_of_birth');
            $table->string('religion');
            $table->string('religion_other');
            $table->string('indigenous_group')->nullable();
            $table->string('indigenous_group_spec')->nullable();
            $table->enum('living_with', ['Both Parents', 'Father Only', 'Mother Only', 'Relatives', 'Non-Relatives', 'Living Alone']);
            $table->enum('dwelling_type', ['Strong Materials', 'Light Materials', 'Makeshift', 'Mixed Strong', 'Mixed Light', 'Mixed Salvaged', 'No Permanent Dwelling']);
            $table->string('contact_number')->nullable();
            $table->string('address_region');
            $table->string('address_province');
            $table->string('address_city');
            $table->string('address_barangay');
            $table->string('address_sitio')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_laborers');
    }
};
