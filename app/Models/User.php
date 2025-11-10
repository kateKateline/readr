<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users'; // optional, default sudah 'users'
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image',
        'profile_banner',
        'level',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
