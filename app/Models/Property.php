<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    protected $fillable = [
        'city_id',
        'area_id',
        'subdivision_phase_id',
        'street_id',
        'property_code',
        'block_no',
        'lot_no',
        'lot_area_sqm',
        'house_no',
        'address',
        'property_type',
        'occupancy_status',
        'property_status',
        'remarks',
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    public function subdivisionPhase(): BelongsTo
    {
        return $this->belongsTo(SubdivisionPhase::class);
    }

    public function street(): BelongsTo
    {
        return $this->belongsTo(Street::class);
    }

    public function ownerships(): HasMany
    {
        return $this->hasMany(PropertyOwnership::class);
    }

    public function currentOwnership()
    {
        return $this->hasOne(PropertyOwnership::class)->where('is_current', true);
    }

    public function occupancies(): HasMany
    {
        return $this->hasMany(PropertyOccupancy::class);
    }

    public function currentOccupancy()
    {
        return $this->hasOne(PropertyOccupancy::class)->where('is_current', true);
    }

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function occupancyStatus()
    {
        return $this->belongsTo(OccupancyStatus::class);
    }

    public function propertyStatus()
    {
        return $this->belongsTo(PropertyStatus::class);
    }
}
