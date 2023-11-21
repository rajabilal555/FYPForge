<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EvaluationPanel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'description',
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
