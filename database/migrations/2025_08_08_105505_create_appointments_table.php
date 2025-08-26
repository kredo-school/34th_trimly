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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('confirmation_number', 255)->unique();
            $table->foreignId('pet_id')->constrained('pets')->onDelete('cascade');
            $table->string('salon_code', 100);
            $table->foreignId('service_item_id')->constrained('service_items')->onDelete('cascade');
            $table->datetime('appointment_date');
            $table->time('appointment_time_start');
            $table->time('appointment_time_end')->nullable();
            $table->integer('status');
            $table->foreign('salon_code')->references('salon_code')->on('salons')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
