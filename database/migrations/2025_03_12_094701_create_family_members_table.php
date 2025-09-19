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
        Schema::create('family_members', function (Blueprint $table) {
            $table->id();
            $table->integer('child_laborer_id');
            $table->string('full_name')->nullable();
            $table->string('relationship')->nullable();
            $table->string('sex')->nullable();
            $table->integer('age')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('education')->nullable();
            $table->string('solo_parent')->nullable();
            $table->string('occupation')->nullable();
            $table->decimal('income', 10, 2)->nullable();
            $table->string('disability')->nullable();
            $table->string('skills')->nullable();
            $table->string('whereabouts')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_members');
    }
};
