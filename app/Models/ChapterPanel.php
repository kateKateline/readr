<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChapterPanel extends Model
{
    protected $fillable = [
        'chapter_id',
        'page_number',
        'image_url',
        'width',
        'height'
    ];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
}
