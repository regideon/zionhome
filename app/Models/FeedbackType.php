<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedbackType extends Model
{
    protected $guarded = [];

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
}