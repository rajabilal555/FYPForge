<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
        'active',
        'result_generated',
    ];

    protected $casts = [
        'start_datetime' => 'datetime',
        'is_final_evaluation' => 'boolean',
        'shuffle_evaluation_panels' => 'boolean',
        'active' => 'boolean',
        'result_generated' => 'boolean',
    ];

    public static function getActiveEvaluationEvent(): ?self
    {
        return self::query()->where('active', true)->first();
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class)
            ->withPivot(['evaluation_date'])
            ->using(EvaluationEventProject::class);
    }

    public function evaluations(): HasMany
    {
        return $this->hasMany(ProjectEvaluation::class);
    }
}
