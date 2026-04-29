<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssociationDueLookup extends Model
{
    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(
            AssociationDueLookupItem::class,
            'association_due_lookup_id'
        );
    }

    public function associationDues()
    {
        return $this->hasMany(
            AssociationDue::class,
            'association_due_lookup_id'
        );
    }
}
