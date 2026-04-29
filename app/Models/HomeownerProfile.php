<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HomeownerProfile extends Model
{
    protected $fillable = [
        'user_id',
        'homeowner_code',
        'contact_number',
        'alternate_contact_number',
        'billing_address',
        'permanent_address',
        'emergency_contact_name',
        'emergency_contact_number',
        'is_active',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function propertyOwnerships()
    {
        return $this->hasMany(
            PropertyOwnership::class,
            'homeowner_profile_id'
        );
    }
}
