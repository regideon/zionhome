<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubdivisionPhase extends Model
{
    protected $fillable = [
        'name',
        'code',
        'description',
        'is_active',
    ];
}
