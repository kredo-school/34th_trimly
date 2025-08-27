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
        Schema::create('pet_owners', function (Blueprint $table) {
            $table->id();
            $table->string('firstname', 100);
            $table->string('lastname', 100);
            $table->string('email_address', 100)->unique();
            $table->string('phone', 20);
            $table->string('city', 100);
            $table->string('prefecture', 100);
            $table->string('password', 255);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pet_owners');
    }
};
