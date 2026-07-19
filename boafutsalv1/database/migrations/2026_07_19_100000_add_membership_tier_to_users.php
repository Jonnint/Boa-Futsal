<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('membership_tier', ['regular', 'vip', 'vvip'])->nullable()->after('is_member');
            $table->timestamp('membership_expired_at')->nullable()->after('membership_tier');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['membership_tier', 'membership_expired_at']);
        });
    }
};
