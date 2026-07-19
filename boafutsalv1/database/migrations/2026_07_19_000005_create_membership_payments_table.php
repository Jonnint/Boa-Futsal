<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('membership_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('payment_method');
            $table->decimal('amount', 10, 2);
            $table->enum('status', ['pending', 'paid', 'expired'])->default('pending');
            $table->timestamp('payment_date')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->string('transaction_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('membership_payments');
    }
};
