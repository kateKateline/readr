<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{
    use HasFactory;

    protected $table = 'comics';

    protected $fillable = [
        'title',
        'author',
        'type',
        'status',
        'age_rating',
        'synopsis',
        'cover_image',
        'cover_banner',
        'chapters',
        'rating',
        'rank',
    ];

    public $timestamps = true; // karena kamu punya created_at & updated_at

    // Relasi ke tabel favorites
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    // Relasi ke tabel bookmarks
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }
}
