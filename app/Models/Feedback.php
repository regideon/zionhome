<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $guarded = [];

    protected $table = 'feedbacks';

    protected $casts = [
        'is_anonymous' => 'boolean',
        'is_emergency' => 'boolean',
        'is_public' => 'boolean',
        'submitted_at' => 'datetime',
        'reviewed_at' => 'datetime',
        'assigned_at' => 'datetime',
        'resolved_at' => 'datetime',
        'closed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function homeownerProfile()
    {
        return $this->belongsTo(HomeownerProfile::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function type()
    {
        return $this->belongsTo(FeedbackType::class, 'feedback_type_id');
    }

    public function category()
    {
        return $this->belongsTo(FeedbackCategory::class, 'feedback_category_id');
    }

    public function status()
    {
        return $this->belongsTo(FeedbackStatus::class, 'feedback_status_id');
    }

    public function priority()
    {
        return $this->belongsTo(FeedbackPriority::class, 'feedback_priority_id');
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function comments()
    {
        return $this->hasMany(FeedbackComment::class);
    }

    public function attachments()
    {
        return $this->hasMany(FeedbackAttachment::class);
    }

    public function aiLogs()
    {
        return $this->hasMany(FeedbackAiLog::class);
    }

    public function subdivisionPhase()
    {
        return $this->belongsTo(\App\Models\SubdivisionPhase::class);
    }

    public function street()
    {
        return $this->belongsTo(\App\Models\Street::class);
    }
}
