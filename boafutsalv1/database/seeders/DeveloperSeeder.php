<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'developer@boafutsal.com'],
            [
                'name' => 'Developer BOA Futsal',
                'phone' => '081299998888',
                'password' => Hash::make('developer123'),
                'role' => 'developer',
                'is_member' => false,
            ]
        );
    }
}
