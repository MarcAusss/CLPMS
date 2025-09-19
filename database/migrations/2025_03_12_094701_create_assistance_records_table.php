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
        Schema::create('assistance_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_laborer_id');
            $table->enum('type_of_assistance', ['Education', 'Health', 'Livelihood', 'Others']);
            $table->string('source');
            $table->string('family_member_received')->nullable();
            $table->date('date_provided');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assistance_records');
    }
};
