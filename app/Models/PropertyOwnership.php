<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropertyOwnership extends Model
{
    protected $fillable = [
        'property_id',
        'owner_user_id',
        'start_date',
        'end_date',
        'is_current',
        'ownership_type',
        'remarks',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_current' => 'boolean',
    ];

    public function homeownerProfile()
    {
        return $this->belongsTo(
            HomeownerProfile::class,
            'homeowner_profile_id'
        );
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
