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
        'sport_type_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function sportType()
    {
        return $this->belongsTo(SportType::class, 'sport_type_id', 'id');
    }

    public function scopeActiveSportType($query)
    {
        return $query->whereHas('sportType', function ($q) {
            $q->where('is_active', true);
        });
    }

    public function prices()
    {
        return $this->hasMany(FieldPrice::class, 'field_id', 'id_field');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'field_id', 'id_field');
    }
}
