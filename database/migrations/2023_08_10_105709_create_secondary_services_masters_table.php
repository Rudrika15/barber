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
        Schema::create('secondary_services_masters', function (Blueprint $table) {
            $table->id();
            $table->integer('primary_service_id');
            $table->string('name');
            $table->string('urlIcon');
            $table->string('business_key');
            $table->string('status')->default("Active");
            $table->enum('is_deleted', ['Yes', 'No'])->default('No');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('secondary_services_masters');
    }
};
