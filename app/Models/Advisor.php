<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class Advisor extends Authenticatable implements FilamentUser
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
        'password',
        'field_of_interests',
        'room_no',
        'slots',
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
        'field_of_interests' => 'array'
    ];

    public static function authUser(): static|Authenticatable
    {
        return Auth::user();
    }

    public function getAvailableSlotsAttribute()
    {
        return $this->slots - $this->projects->count();
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function invites()
    {
        return $this->hasMany(ProjectAdvisorInvite::class);
    }

    public function pendingProjectInvites()
    {
        return $this->hasMany(ProjectAdvisorInvite::class)->where('status', 'pending');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
}
