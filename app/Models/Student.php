<?php

namespace App\Models;

use App\Traits\DataTableSource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Student extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, DataTableSource;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'registration_no',
        'password',
    ];

    protected function allowedFilters(): array
    {
        return [
            'name' => function (Builder $builder, $name, $value) {
                return $builder->where($name, 'LIKE', '%' . $value . '%');
            },
            'email' => function (Builder $builder, $name, $value) {
                return $builder->where($name, 'LIKE', '%' . $value . '%');
            },
        ];
    }


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

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

}
