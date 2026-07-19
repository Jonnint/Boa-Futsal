<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoucherUsage extends Model
{
    protected $table = 'voucher_usage';

    protected $fillable = [
        'voucher_id', 'user_id', 'booking_id', 
        'discount_amount', 'used_at'
    ];

    protected $casts = [
        'discount_amount' => 'decimal:2',
        'used_at' => 'datetime',
    ];

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'id_booking');
    }
}
