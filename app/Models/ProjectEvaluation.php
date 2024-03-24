<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectEvaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'evaluation_panel_id',
        'student_id',
        'marks',
        'term',
        'comments',
        'is_final',
    ];

    protected $casts = [
        'is_final' => 'boolean',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function evaluation_panel(): BelongsTo
    {
        return $this->belongsTo(EvaluationPanel::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
