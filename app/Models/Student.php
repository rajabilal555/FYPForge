<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class Student extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'registration_no',
        'project_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function authUser(): static|Authenticatable
    {
        return Auth::user();
    }

    public function getNameWithRegistrationAttribute()
    {
        return $this->name.' ('.$this->registration_no.')';
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function memberInvites()
    {
        return $this->hasMany(ProjectMemberInvite::class);
    }

    public function advisorInvites()
    {
        return $this->hasMany(ProjectAdvisorInvite::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
}
