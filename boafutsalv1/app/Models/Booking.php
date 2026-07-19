<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $primaryKey = 'id_booking';

    protected $fillable = [
        'user_id',
        'field_id',
        'booking_date',
        'start_time',
        'end_time',
        'duration_hours',
        'price_per_hour',
        'total_price',
        'is_member_price',
        'status',
        'notes',
        'guest_name',
        'guest_email',
        'guest_phone',
        'booking_type',
        'voucher_id',
        'voucher_code',
        'original_price',
        'discount_amount',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'price_per_hour' => 'decimal:2',
        'total_price' => 'decimal:2',
        'is_member_price' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    public function field()
    {
        return $this->belongsTo(Field::class, 'field_id', 'id_field');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'booking_id', 'id_booking');
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }
}
