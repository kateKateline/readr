<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{
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
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'rating' => 'float',
        'chapters' => 'integer',
        'rank' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
