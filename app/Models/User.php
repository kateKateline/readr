<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Favorite;
use App\Models\Bookmark;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'username',
        'email',
        'password',
        'profile',
        'role',
        'created_at',
    ];

    public $timestamps = false;

    protected $casts = [
        'created_at' => 'datetime',
    ];  

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }
}
