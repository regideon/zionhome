<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $guarded = [];

    protected $casts = [
        'expense_date' => 'date',
    ];

    public function category()
    {
        return $this->belongsTo(ExpenseCategory::class, 'expense_category_id');
    }

    public function status()
    {
        return $this->belongsTo(ExpenseStatus::class, 'expense_status_id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class);
    }

    public function items()
    {
        return $this->hasMany(ExpenseItem::class);
    }
}
