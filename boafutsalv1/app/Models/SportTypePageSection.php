<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SportTypePageSection extends Model
{
    protected $fillable = [
        'sport_type_id',
        'page_key',
        'section_key',
        'label',
        'content_type',
        'content_value',
        'image_path',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    public function sportType(): BelongsTo
    {
        return $this->belongsTo(SportType::class, 'sport_type_id', 'id');
    }

    /**
     * Get content value decoded if it is JSON / list_item, or raw string otherwise.
     */
    public function getParsedValueAttribute()
    {
        if ($this->content_type === 'list_item') {
            $decoded = json_decode($this->content_value, true);
            return json_last_error() === JSON_ERROR_NONE ? $decoded : $this->content_value;
        }

        return $this->content_value;
    }
}
