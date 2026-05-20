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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('id_booking');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('field_id');
            $table->foreign('field_id')->references('id_field')->on('fields')->onDelete('cascade');
            $table->date('booking_date'); // Tanggal booking
            $table->time('start_time'); // Jam mulai
            $table->time('end_time'); // Jam selesai
            $table->integer('duration_hours'); // Durasi dalam jam
            $table->decimal('price_per_hour', 10, 2); // Harga per jam yang dipakai
            $table->decimal('total_price', 10, 2); // Total harga
            $table->boolean('is_member_price')->default(false); // Apakah pakai harga member
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending');
            $table->text('notes')->nullable(); // Catatan tambahan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
