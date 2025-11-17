<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manga extends Model
{
    protected $fillable = [
        'manga_id',
        'title',
        'type',
        'cover_file'
    ];
}

