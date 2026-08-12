<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@boafutsal.com'],
            [
                'name' => 'Admin BOA Futsal',
                'phone' => '081234567890',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'is_member' => false,
            ]
        );
    }
}
