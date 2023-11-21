<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\File;

class ProjectFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'storage_path',
        'storage_disk',
        'project_id',
        'student_id',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function getFileType()
    {
        return File::extension($this->storage_path);
    }
}
