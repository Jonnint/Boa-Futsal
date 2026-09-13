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
        Schema::create('sport_type_page_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sport_type_id')->constrained('sport_types')->cascadeOnDelete();
            $table->string('page_key');
            $table->string('section_key');
            $table->string('label');
            $table->string('content_type')->default('text'); // text, richtext, image, list_item
            $table->longText('content_value')->nullable();
            $table->string('image_path')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->unique(['sport_type_id', 'page_key', 'section_key'], 'st_page_section_unique');
            $table->index(['sport_type_id', 'page_key']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sport_type_page_sections');
    }
};
