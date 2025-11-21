<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{
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
}