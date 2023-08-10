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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('mobile');
            $table->string('email');
            $table->string('businessName');
            $table->string('personFName');
            $table->string('personLName');
            $table->string('addressLine1')->nullable(true);
            $table->string('addressLine2')->nullable(true);;
            $table->string('landMark')->nullable(true);;
            $table->string('state')->nullable(true);;
            $table->string('city')->nullable(true);;
            $table->string('pincode')->nullable(true);;
            $table->string('latitude')->nullable(true);;
            $table->string('longtitude')->nullable(true);;
            $table->string('logo')->nullable(true);;
            $table->string('auth_token')->nullable(true);;
            $table->string('isEmail_verify')->nullable(true);;
            $table->string('isMobile_verify')->nullable(true);;
            $table->string('processDone')->nullable(true);;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
