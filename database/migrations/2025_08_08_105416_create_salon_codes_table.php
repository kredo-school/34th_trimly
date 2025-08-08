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
        Schema::create('salon_codes', function (Blueprint $table) {
            $table->id();
            $table->string('salon_code', 100)->unique();
            $table->foreignId('petowner_id')->constrained('pet_owners')->onDelete('cascade');
            $table->foreign('salon_code')->references('salon_code')->on('salons')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salon_codes');
    }
};
