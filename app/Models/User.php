<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public const STUDENT = 1;
    public const TEACHER = 2;

    public const MR = 1;
    public const MRS = 2;
    public const MASTER = 3;
    public const MISS = 4;

    protected $fillable =
    [
        'title',
        'first_name',
        'last_name',
        'email',
        'password',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function files()
    {
        return $this->belongsToMany(File::class, 'file_users');
    }
}
