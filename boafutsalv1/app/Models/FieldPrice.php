<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FieldPrice extends Model
{
    protected $primaryKey = 'id_field_price';

    protected $fillable = [
        'field_id',
        'day_type',
        'start_time',
        'end_time',
        'price_regular',
        'price_member',
    ];

    protected $casts = [
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'price_regular' => 'decimal:2',
        'price_member' => 'decimal:2',
    ];

    public function field()
    {
        return $this->belongsTo(Field::class, 'field_id', 'id_field');
    }
}
