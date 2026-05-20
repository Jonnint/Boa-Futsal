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
        Schema::create('field_prices', function (Blueprint $table) {
            $table->id('id_field_price');
            $table->unsignedBigInteger('field_id');
            $table->foreign('field_id')->references('id_field')->on('fields')->onDelete('cascade');
            $table->enum('day_type', ['weekday', 'weekend']); // Senin-Jumat atau Sabtu-Minggu
            $table->time('start_time'); // Jam mulai (07:00, 12:00, 16:00)
            $table->time('end_time'); // Jam selesai (12:00, 16:00, 00:00)
            $table->decimal('price_regular', 10, 2); // Harga umum
            $table->decimal('price_member', 10, 2); // Harga member
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('field_prices');
    }
};
