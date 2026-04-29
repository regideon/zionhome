<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $guarded = [];

    public function chartOfAccount()
    {
        return $this->belongsTo(ChartOfAccount::class);
    }
}
