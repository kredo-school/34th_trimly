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
        Schema::create('salons', function (Blueprint $table) {
            $table->id();
            $table->string('salon_code', 100)->unique();
            $table->string('salonname', 100);
            $table->string('firstname', 100);
            $table->string('lastname', 100);
            $table->string('email_address', 100);
            $table->string('phone', 20);
            $table->string('state', 100);
            $table->string('password', 255);
            $table->string('website', 255)->nullable();
            $table->string('licencenum', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->time('open_time');
            $table->time('close_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salons');
    }
};
