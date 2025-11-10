<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{
    protected $table = 'comics'; // Nama tabel SQL kamu
    public $timestamps = false;  // Karena kamu pakai uploaded_at & updated_at manual

    protected $fillable = [
        'title',
        'author',
        'type',
        'cover_image',
        'banner_image',
        'desc',
        'genre',
        'release_date',
        'status',
        'updated_at',
        'uploaded_at'
    ];
}
