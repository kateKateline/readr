<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $fillable = [
        'mangadex_id',
        'comic_id',
        'title',
        'chapter_number',
        'volume',
        'publish_at',
        'external_url',
        'is_unavailable',
        'md_updated_at',
        'hash',
        'data',
        'data_saver',
        'pages',
    ];

    protected $casts = [
        'data' => 'array',
        'data_saver' => 'array',
        'is_unavailable' => 'boolean',
    ];

    private function toMysqlDatetime(?string $date)
{
    if (!$date) return null;

    return date('Y-m-d H:i:s', strtotime($date));
}


    public function comic()
    {
        return $this->belongsTo(Comic::class);
    }

    public function panels()
    {
        return $this->hasMany(ChapterPanel::class);
    }
}
