<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
        'uploaded_at',
        'slug', // tambahkan ini agar slug bisa diisi otomatis
    ];

    // 🔹 Fungsi agar slug otomatis dibuat dari title
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($comic) {
            if (empty($comic->slug)) {
                $comic->slug = Str::slug($comic->title);
            }
        });

        static::updating(function ($comic) {
            if (empty($comic->slug)) {
                $comic->slug = Str::slug($comic->title);
            }
        });
    }
}
