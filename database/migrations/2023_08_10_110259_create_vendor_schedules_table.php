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
        Schema::create('vendor_schedules', function (Blueprint $table) {
            $table->id();
            $table->integer('vendorId');
            $table->string('day');
            $table->string('openingTime');
            $table->string('closingTime');
            $table->string('dayOff');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_schedules');
    }
};
