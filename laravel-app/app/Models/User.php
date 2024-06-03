<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function dean()
    {
        return $this->hasOne(Dean::class, 'user_id');
    }

    public function student()
    {
        return $this->hasOne(Student::class, 'user_id');
    }
    public function coordinator()
    {
        return $this->hasOne(Coordinator::class, 'user_id');
    }

    public function hasRole($role)
    {
        return $this->role === $role;
    }

}
