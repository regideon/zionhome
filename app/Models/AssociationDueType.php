<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssociationDueType extends Model
{
    protected $guarded = [];
    
    public function incomeAccount()
    {
        return $this->belongsTo(ChartOfAccount::class, 'income_account_id');
    }
}
