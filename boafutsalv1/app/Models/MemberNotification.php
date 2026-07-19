<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberNotification extends Model
{
    protected $fillable = [
        'user_id', 'title', 'message', 'type', 
        'voucher_id', 'is_read', 'expires_at'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'expires_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public function scopeActive($query)
    {
        return $query->where(function($q) {
            $q->whereNull('expires_at')
              ->orWhere('expires_at', '>', now());
        });
    }

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }
}
