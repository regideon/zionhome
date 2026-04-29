<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    protected $fillable = [
        'subdivision_phase_id',
        'name',
        'is_active',
    ];

    public function subdivisionPhase()
    {
        return $this->belongsTo(SubdivisionPhase::class);
    }
}