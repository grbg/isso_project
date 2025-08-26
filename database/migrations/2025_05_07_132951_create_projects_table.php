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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->foreignId('id_location')->references('id')->on('locations')->onUpdate('cascade');
            $table->text('infrastucture_info');
            $table->text('architecture_info');
            $table->text('environment_info');
            $table->text('transport_info');
            $table->enum('status', ['Completed', 'In process', 'Uncompleted'])->default('Uncompleted');
            $table->date('start_date')->nullable(); // Дата начала строительства
            $table->date('end_date')->nullable();   // Дата завершения строительства
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
