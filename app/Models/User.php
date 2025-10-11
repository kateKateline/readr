<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasFactory;

    // Nama tabel
    protected $table = 'users';

    // Kolom yang bisa diisi
    protected $fillable = [
        'username',
        'email',
        'password',
        'profile',
        'role',
        'created_at',
    ];

    // Karena kamu hanya punya created_at (tanpa updated_at)
    public $timestamps = false;

    // Optional: kalau kamu mau Laravel tahu created_at adalah kolom tanggal
    protected $casts = [
        'created_at' => 'datetime',
    ];
}
