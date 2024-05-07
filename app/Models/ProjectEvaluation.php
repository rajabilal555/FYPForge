<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectEvaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'evaluation_event_id',
        'project_id',
        'evaluation_panel_id',
        'student_id',
        'marks',
        'term',
        'comments',
    ];

    protected $casts = [
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function evaluation_panel(): BelongsTo
    {
        return $this->belongsTo(EvaluationPanel::class);
    }

    public function evaluation_event(): BelongsTo
    {
        return $this->belongsTo(EvaluationEvent::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
