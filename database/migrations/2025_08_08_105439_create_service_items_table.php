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
        Schema::create('service_items', function (Blueprint $table) {
            $table->id();
            $table->string('salon_code', 100);
            $table->string('servicename', 100);
            $table->string('category', 100);
            $table->integer('duration');
            $table->decimal('price', 10, 2);
            $table->longText('description');
            $table->integer('servicefeatures');
            $table->foreign('salon_code')->references('salon_code')->on('salons')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_items');
    }
};
