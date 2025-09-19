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
        Schema::create('requested_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_laborer_id');
            $table->enum('service_type', ['Education', 'Health', 'Livelihood', 'Legal', 'Psychosocial', 'Others']);
            $table->text('specific_service')->nullable();
            $table->date('date_requested')->default(now());
            $table->enum('status', ['Pending', 'Approved', 'Denied', 'Completed'])->default('Pending');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requested_services');
    }
};
