<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'student_id',
        'total_marks',
        'total_marks_obtained',
        'marks_breakdown_data',
        'evaluation_event_ids',
    ];

    protected $casts = [
        'marks_breakdown_data' => 'array',
        'evaluation_event_ids' => 'array',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
