<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $guarded = [];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
