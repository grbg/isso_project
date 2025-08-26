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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('city', 255);
            $table->string('street', 255)->nullable();
            $table->string('house', 5)->nullable();
            $table->decimal('latitude', 10, 8)->nullable(); // Широта (-90 до +90)
            $table->decimal('longitude', 11, 8)->nullable(); // Долгота (-180 до +180)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
