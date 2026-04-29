<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedbackAttachment extends Model
{
    protected $guarded = [];

    public function feedback()
    {
        return $this->belongsTo(Feedback::class);
    }
}
