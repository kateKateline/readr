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
        'genre',
        'type',
        'status',
        'age_rating',
        'synopsis',
        'cover_image',
        'cover_banner',
        'chapters',
        'rating',
        'rank',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true; // karena kamu punya created_at & updated_at

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }
}
