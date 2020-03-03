<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'firstname', 
        'lastname',
        'email', 
        'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeFilter($query, $string)
    {
        return $query->where('firstname', 'LIKE', "%{$string}%")
            ->orWhere('lastname', 'LIKE', "%{$string}%")
            ->orWhere('email', 'LIKE', "%{$string}%");
    }
}
