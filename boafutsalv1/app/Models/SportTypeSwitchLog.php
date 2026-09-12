<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SportTypeSwitchLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'from_sport_type_id',
        'to_sport_type_id',
        'action',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    public function fromSportType(): BelongsTo
    {
        return $this->belongsTo(SportType::class, 'from_sport_type_id', 'id');
    }

    public function toSportType(): BelongsTo
    {
        return $this->belongsTo(SportType::class, 'to_sport_type_id', 'id');
    }
}
