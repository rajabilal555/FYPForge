<?php

namespace App\Models;

use App\Enums\ProjectApprovalStatus;
use App\Enums\ProjectStatus;
use App\Enums\ProjectTerm;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'status',
        'approval_status',
        'term',
        'panel_id',
        'advisor_id',
        'member_limit',
        'is_archived',
        'temp_advisor_marks',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status' => ProjectStatus::InProgress,
        'approval_status' => ProjectApprovalStatus::Draft,
        'term' => ProjectTerm::FYP1,
    ];

    protected $casts = [
        'status' => ProjectStatus::class,
        'approval_status' => ProjectApprovalStatus::class,
        'term' => ProjectTerm::class,
        'is_archived' => 'boolean',
    ];

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function memberInvites(): HasMany
    {
        return $this->hasMany(ProjectMemberInvite::class);
    }

    public function pendingMemberInvites(): HasMany
    {
        return $this->hasMany(ProjectMemberInvite::class)->where('status', 'pending');
    }

    public function advisorInvites(): HasMany
    {
        return $this->hasMany(ProjectAdvisorInvite::class);
    }

    public function pendingAdvisorInvites(): HasMany
    {
        return $this->hasMany(ProjectAdvisorInvite::class)->where('status', 'pending');
    }

    public function evaluationPanel(): BelongsTo
    {
        return $this->belongsTo(EvaluationPanel::class);
    }

    public function evaluations(): HasMany
    {
        return $this->hasMany(ProjectEvaluation::class);
    }

    public function isMemberLimitReached(): bool
    {
        return $this->students()->count() >= $this->member_limit;
    }

    public function evaluationEvents(): BelongsToMany
    {
        return $this->belongsToMany(EvaluationEvent::class)
            ->withPivot(['evaluation_date'])
            ->using(EvaluationEventProject::class);
    }

    public function latestEvaluationEvent(): ?EvaluationEvent
    {
        return $this->evaluationEvents()->orderByPivot('evaluation_date', 'desc')->first();
    }

    public function getCurrentEvaluations(): Collection
    {
        return $this->latestEvaluationEvent()
            ?->evaluations()
            ->where('project_id', $this->id)
            ->get() ?? collect();
    }

    public function hasCurrentEvaluation(): bool
    {
        return $this->getCurrentEvaluations()->isNotEmpty();
    }

    public function advisor(): BelongsTo
    {
        return $this->belongsTo(Advisor::class);
    }

    public function files(): HasMany
    {
        return $this->hasMany(ProjectFile::class);
    }

    public function queries(): HasMany
    {
        return $this->hasMany(ProjectQuery::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(ProjectTask::class);
    }

    public function results(): HasMany
    {
        return $this->hasMany(ProjectResult::class);
    }
}
