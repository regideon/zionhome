<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropertyOccupancy extends Model
{
    protected $fillable = [
        'property_id',
        'occupant_user_id',
        'occupant_name',
        'contact_number',
        'occupancy_type',
        'move_in_date',
        'move_out_date',
        'is_current',
        'remarks',
    ];

    protected $casts = [
        'move_in_date' => 'date',
        'move_out_date' => 'date',
        'is_current' => 'boolean',
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function occupant(): BelongsTo
    {
        return $this->belongsTo(User::class, 'occupant_user_id');
    }
}
