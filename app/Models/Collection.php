<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $guarded = [];

    protected $casts = [
        'paid_date' => 'date',
        'verified_at' => 'datetime',
    ];

    public function associationDue()
    {
        return $this->belongsTo(AssociationDue::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function homeownerProfile()
    {
        return $this->belongsTo(HomeownerProfile::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function paymentStatus()
    {
        return $this->belongsTo(PaymentStatus::class);
    }

    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class);
    }
}