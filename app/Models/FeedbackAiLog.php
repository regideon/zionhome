<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedbackAiLog extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_high_risk' => 'boolean',
        'raw_response' => 'array',
    ];

    public function feedback()
    {
        return $this->belongsTo(Feedback::class);
    }
}
