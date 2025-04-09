<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'username',
        'password',
        'isVerified',
        'admin_id',
    ];



    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'isVerified' => 'boolean',
        'password' => 'hashed',
    ];
    public function admin()
    {
        return $this->hasOne(Admin::class, 'user_id', 'user_id');
    }
    public function isAdmin()
    {
        return $this->admin()->exists();
    }
}
