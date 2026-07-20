<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipPayment extends Model
{
    protected $fillable = [
        'user_id', 'payment_method', 'membership_tier', 'amount', 
        'status', 'rejection_reason', 'payment_proof', 'payment_date', 'expired_at', 'transaction_id'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'datetime',
        'expired_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }
}
