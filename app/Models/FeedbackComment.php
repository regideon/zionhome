<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedbackComment extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_internal' => 'boolean',
    ];

    public function feedback()
    {
        return $this->belongsTo(Feedback::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
