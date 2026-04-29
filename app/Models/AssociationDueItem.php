<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssociationDueItem extends Model
{
    protected $guarded = [];

    public function status()
    {
        return $this->belongsTo(AssociationDueItemStatus::class, 'association_due_item_status_id');
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
