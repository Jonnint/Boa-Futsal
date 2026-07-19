<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->foreignId('voucher_id')->nullable()->after('total_price')->constrained()->onDelete('set null');
            $table->string('voucher_code')->nullable()->after('voucher_id');
            $table->decimal('original_price', 10, 2)->nullable()->after('voucher_code');
            $table->decimal('discount_amount', 10, 2)->default(0)->after('original_price');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['voucher_id']);
            $table->dropColumn(['voucher_id', 'voucher_code', 'original_price', 'discount_amount']);
        });
    }
};
