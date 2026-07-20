<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ChatbotSetting;

class ChatbotSettingSeeder extends Seeder
{
    public function run(): void
    {
        ChatbotSetting::firstOrCreate([], [
            'wa_number' => env('FONNTE_WA_NUMBER', '6281234567890'),
            'api_token' => env('FONNTE_API_TOKEN', ''),
            'user_message_template' => "Hallo Kak Selamat {greeting}. Saya sudah Join Member dan Sudah Upload Bukti Pembayarannya ya! tolong di Approve, agar bisa menggunakan fitur Member, Terimakasih Kak!!",
            'reply_message_template' => "Hallo Selamat {greeting} juga Sobat BoaFutsal, Baik Terimakasih atas tertariknya join member di lapangan futsal kami ya!",
            'is_active' => true,
        ]);
    }
}
