<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{
    protected $fillable = [
        'mangadex_id',
        'title',
        'type',
        'image',
        'status',
        'last_update',
    ];
}
