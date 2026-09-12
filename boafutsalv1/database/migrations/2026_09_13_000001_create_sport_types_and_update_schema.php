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
        // 1. Update users role to include 'developer'
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('user', 'admin', 'developer') NOT NULL DEFAULT 'user'");

        // 2. Create sport_types table
        Schema::create('sport_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('hero_title');
            $table->text('hero_subtitle')->nullable();
            $table->text('description')->nullable();
            $table->string('hero_image_path')->nullable();
            $table->json('facilities')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });

        // 3. Create sport_type_galleries table
        Schema::create('sport_type_galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sport_type_id')->nullable()->constrained('sport_types')->nullOnDelete();
            $table->string('image_path');
            $table->string('archived_path')->nullable();
            $table->string('caption')->nullable();
            $table->integer('order')->default(0);
            $table->timestamp('archived_at')->nullable();
            $table->timestamps();
        });

        // 4. Add sport_type_id to fields table
        Schema::table('fields', function (Blueprint $table) {
            $table->foreignId('sport_type_id')->nullable()->after('id_field')->constrained('sport_types')->nullOnDelete();
        });

        // 5. Add snapshot columns to bookings table
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('sport_type_name_snapshot')->nullable()->after('field_id');
            $table->string('field_name_snapshot')->nullable()->after('sport_type_name_snapshot');
        });

        // 6. Create sport_type_switch_logs table
        Schema::create('sport_type_switch_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'id_user')->cascadeOnDelete();
            $table->foreignId('from_sport_type_id')->nullable()->constrained('sport_types')->nullOnDelete();
            $table->foreignId('to_sport_type_id')->nullable()->constrained('sport_types')->nullOnDelete();
            $table->string('action'); // 'activate', 'delete'
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sport_type_switch_logs');

        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['sport_type_name_snapshot', 'field_name_snapshot']);
        });

        Schema::table('fields', function (Blueprint $table) {
            $table->dropForeign(['sport_type_id']);
            $table->dropColumn('sport_type_id');
        });

        Schema::dropIfExists('sport_type_galleries');
        Schema::dropIfExists('sport_types');

        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('user', 'admin') NOT NULL DEFAULT 'user'");
    }
};
