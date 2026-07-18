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
        Schema::table('bookings', function (Blueprint $table) {
            // Make user_id nullable for guest bookings
            $table->unsignedBigInteger('user_id')->nullable()->change();
            
            // Add guest information fields
            $table->string('guest_name')->nullable()->after('user_id');
            $table->string('guest_email')->nullable()->after('guest_name');
            $table->string('guest_phone')->nullable()->after('guest_email');
            
            // Add booking type to distinguish between guest and member bookings
            $table->enum('booking_type', ['guest', 'member'])->default('guest')->after('guest_phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Remove guest fields
            $table->dropColumn(['guest_name', 'guest_email', 'guest_phone', 'booking_type']);
            
            // Make user_id required again
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
        });
    }
};
