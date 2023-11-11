<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'panel_id',
        'created_by',
        'updated_by',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status' => ProjectStatus::Draft,
    ];

    protected $casts = [
        'status' => ProjectStatus::class,
    ];

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function invites(): HasMany
    {
        return $this->hasMany(ProjectInvite::class);
    }

    public function evaluation_panel(): BelongsTo
    {
        return $this->belongsTo(EvaluationPanel::class);
    }

    public function advisor(): BelongsTo
    {
        return $this->belongsTo(Advisor::class);
    }

    public function files(): HasMany
    {
        return $this->hasMany(ProjectFile::class);
    }

}
