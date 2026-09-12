<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SportTypeGallery extends Model
{
    protected $fillable = [
        'sport_type_id',
        'image_path',
        'archived_path',
        'caption',
        'order',
        'archived_at',
    ];

    protected $casts = [
        'archived_at' => 'datetime',
        'order' => 'integer',
    ];

    public function sportType(): BelongsTo
    {
        return $this->belongsTo(SportType::class, 'sport_type_id', 'id');
    }
}
