<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $primaryKey = 'id_field';

    protected $fillable = [
        'name',
        'description',
        'image',
        'surface_type',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function prices()
    {
        return $this->hasMany(FieldPrice::class, 'field_id', 'id_field');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'field_id', 'id_field');
    }
}
