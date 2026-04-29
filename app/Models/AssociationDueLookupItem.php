<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssociationDueLookupItem extends Model
{
    protected $guarded = [];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function lookup()
    {
        return $this->belongsTo(
            AssociationDueLookup::class,
            'association_due_lookup_id'
        );
    }
}
