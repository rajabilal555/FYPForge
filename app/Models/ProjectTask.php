<?php

namespace App\Models;

use App\Enums\ProjectTaskStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'project_id',
        'remarks',
        'due_date',
    ];

    protected $attributes = [
        'status' => ProjectTaskStatus::Assigned,
    ];

    protected $casts = [
        'status' => ProjectTaskStatus::class,
        'due_date' => 'datetime',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
