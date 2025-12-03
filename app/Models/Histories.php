<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Histories extends Model
{
    use HasFactory;

    protected $table = 'histories';

    protected $fillable = [
        'user_id',
        'comic_id',
        'last_viewed_chapter',
        'last_viewed_page',
    ];

    protected $casts = [
        'last_viewed_chapter' => 'integer',
        'last_viewed_page' => 'integer',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Comic
     */
    public function comic()
    {
        return $this->belongsTo(Comic::class);
    }

    /**
     * Relasi ke Chapter (optional, untuk mendapatkan detail chapter terakhir)
     */
    public function chapter()
    {
        return $this->belongsTo(Chapter::class, 'last_viewed_chapter', 'id');
    }
}

