<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EvaluationEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_datetime',
        'per_project_duration',
        'total_marks',
        'is_final_evaluation',
        'shuffle_evaluation_panels',
    ];

    protected $casts = [
        'start_datetime' => 'datetime',
        'is_final_evaluation' => 'boolean',
        'shuffle_evaluation_panels' => 'boolean',
    ];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function projectEvaluations(): HasMany
    {
        return $this->hasMany(ProjectEvaluation::class);
    }
}
