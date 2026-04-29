<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssociationDue extends Model
{
    protected $guarded = [];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function homeownerProfile()
    {
        return $this->belongsTo(HomeownerProfile::class);
    }

    public function type()
    {
        return $this->belongsTo(AssociationDueType::class, 'association_due_type_id');
    }

    public function status()
    {
        return $this->belongsTo(AssociationDueStatus::class, 'association_due_status_id');
    }

    public function items()
    {
        return $this->hasMany(AssociationDueItem::class);
    }

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }

    public function lookup()
    {
        return $this->belongsTo(AssociationDueLookup::class, 'association_due_lookup_id');
    }
}
