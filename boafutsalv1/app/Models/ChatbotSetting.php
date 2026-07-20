<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatbotSetting extends Model
{
    protected $table = 'chatbot_settings';

    protected $fillable = [
        'wa_number',
        'api_token',
        'user_message_template',
        'reply_message_template',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the active/first chatbot configuration, or create a default one.
     */
    public static function getSettings()
    {
        try {
            return self::firstOrCreate([], [
                'wa_number' => '6281234567890',
                'api_token' => '',
                'user_message_template' => "Hallo Kak Selamat {greeting}. Saya sudah Join Member dan Sudah Upload Bukti Pembayarannya ya! tolong di Approve, agar bisa menggunakan fitur Member, Terimakasih Kak!!",
                'reply_message_template' => "Hallo Selamat {greeting} juga Sobat BoaFutsal, Baik Terimakasih atas tertariknya join member di lapangan futsal kami ya!",
                'is_active' => true,
            ]);
        } catch (\Exception $e) {
            // Fallback if database migration hasn't been run yet
            $fallback = new self([
                'wa_number' => '6281234567890',
                'api_token' => '',
                'user_message_template' => "Hallo Kak Selamat {greeting}. Saya sudah Join Member dan Sudah Upload Bukti Pembayarannya ya! tolong di Approve, agar bisa menggunakan fitur Member, Terimakasih Kak!!",
                'reply_message_template' => "Hallo Selamat {greeting} juga Sobat BoaFutsal, Baik Terimakasih atas tertariknya join member di lapangan futsal kami ya!",
                'is_active' => true,
            ]);
            return $fallback;
        }
    }
}
