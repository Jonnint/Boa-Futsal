<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('membership_payments', function (Blueprint $table) {
            $table->string('rejection_reason')->nullable()->after('status');
        });

        DB::statement("ALTER TABLE membership_payments MODIFY COLUMN status ENUM('pending', 'paid', 'expired', 'rejected') NOT NULL DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('membership_payments', function (Blueprint $table) {
            $table->dropColumn('rejection_reason');
        });

        DB::statement("ALTER TABLE membership_payments MODIFY COLUMN status ENUM('pending', 'paid', 'expired') NOT NULL DEFAULT 'pending'");
    }
};
