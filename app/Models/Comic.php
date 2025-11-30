<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{
    use HasFactory;

    protected $table = 'comics';

    protected $fillable = [
        'mangadex_id',
        'title',
        'author',
        'type',
        'image',
        'status',
        'is_sensitive',
        'last_update',
        'last_chapter',
        'rating',
        'rating_count',
    ];

    protected $casts = [
        'is_sensitive' => 'boolean',
        'last_update' => 'datetime',
        'rating' => 'decimal:2',
    ];

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    // TAMBAHKAN INI 👇
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}   