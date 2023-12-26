<?php

namespace App\Models;

use App\Enums\ProjectInviteStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectAdvisorInvite extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'project_id',
        'advisor_id',
        'sent_by',
        'status',
        'expires_at',
    ];

    protected $attributes = [
        'status' => ProjectInviteStatus::Pending,
    ];

    protected $casts = [
        'status' => ProjectInviteStatus::class,
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function advisor(): BelongsTo
    {
        return $this->belongsTo(Advisor::class);
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'sent_by');
    }
}
