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
        Schema::create('fields', function (Blueprint $table) {
            $table->id('id_field');
            $table->string('name'); // Lapangan BF 01, BF 02, BF 03
            $table->text('description')->nullable();
            $table->string('image')->nullable(); // Path gambar
            $table->string('surface_type')->default('Rumput Sintetis'); // Jenis rumput
            $table->boolean('is_active')->default(true); // Status lapangan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fields');
    }
};
