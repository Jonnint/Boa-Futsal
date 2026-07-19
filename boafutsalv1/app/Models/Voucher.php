<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Voucher extends Model
{
    protected $fillable = [
        'code', 'name', 'description', 'type', 'discount_value',
        'min_booking_amount', 'max_discount', 'valid_from', 'valid_until',
        'is_member_only', 'usage_limit', 'usage_per_user',
        'applicable_days', 'applicable_times', 'is_active'
    ];

    protected $casts = [
        'discount_value' => 'decimal:2',
        'min_booking_amount' => 'decimal:2',
        'max_discount' => 'decimal:2',
        'valid_from' => 'date',
        'valid_until' => 'date',
        'is_member_only' => 'boolean',
        'is_active' => 'boolean',
        'applicable_days' => 'array',
        'applicable_times' => 'array',
    ];

    public function usages()
    {
        return $this->hasMany(VoucherUsage::class);
    }

    public function isValid()
    {
        return $this->is_active 
            && Carbon::now()->between($this->valid_from, $this->valid_until);
    }

    public function canBeUsedBy($userId, $bookingAmount, $bookingDate)
    {
        if (!$this->isValid()) return false;
        
        if ($this->min_booking_amount && $bookingAmount < $this->min_booking_amount) {
            return false;
        }

        if ($this->usage_limit && $this->usages()->count() >= $this->usage_limit) {
            return false;
        }

        if ($userId && $this->usage_per_user) {
            $userUsage = $this->usages()->where('user_id', $userId)->count();
            if ($userUsage >= $this->usage_per_user) return false;
        }

        if ($this->applicable_days) {
            $dayOfWeek = Carbon::parse($bookingDate)->dayOfWeek;
            if (!in_array($dayOfWeek, $this->applicable_days)) return false;
        }

        return true;
    }

    public function calculateDiscount($amount)
    {
        if ($this->type === 'percentage') {
            $discount = $amount * ($this->discount_value / 100);
            if ($this->max_discount && $discount > $this->max_discount) {
                $discount = $this->max_discount;
            }
            return $discount;
        }
        
        return min($this->discount_value, $amount);
    }
}
