<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Voucher;
use Carbon\Carbon;

class VoucherSeeder extends Seeder
{
    public function run(): void
    {
        $vouchers = [
            [
                'code' => 'WELCOME10',
                'name' => 'Welcome Member Discount',
                'description' => 'Diskon 10% untuk member baru',
                'type' => 'percentage',
                'discount_value' => 10,
                'min_booking_amount' => 100000,
                'max_discount' => 50000,
                'valid_from' => Carbon::now(),
                'valid_until' => Carbon::now()->addMonths(3),
                'is_member_only' => true,
                'usage_limit' => null,
                'usage_per_user' => 1,
                'is_active' => true,
            ],
            [
                'code' => 'WEEKEND20',
                'name' => 'Weekend Special',
                'description' => 'Diskon 20% khusus weekend',
                'type' => 'percentage',
                'discount_value' => 20,
                'min_booking_amount' => 150000,
                'max_discount' => 100000,
                'valid_from' => Carbon::now(),
                'valid_until' => Carbon::now()->addMonth(),
                'is_member_only' => true,
                'usage_limit' => 100,
                'usage_per_user' => 3,
                'applicable_days' => [0, 6], // Sunday & Saturday
                'is_active' => true,
            ],
            [
                'code' => 'MALAM50',
                'name' => 'Diskon Malam',
                'description' => 'Diskon Rp50.000 untuk booking malam',
                'type' => 'fixed',
                'discount_value' => 50000,
                'min_booking_amount' => 200000,
                'max_discount' => null,
                'valid_from' => Carbon::now(),
                'valid_until' => Carbon::now()->addWeeks(2),
                'is_member_only' => false,
                'usage_limit' => 50,
                'usage_per_user' => 2,
                'applicable_times' => ['18:00-23:59'],
                'is_active' => true,
            ],
        ];

        foreach ($vouchers as $voucher) {
            Voucher::create($voucher);
        }
    }
}
