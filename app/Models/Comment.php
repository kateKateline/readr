<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'comic_id',
        'parent_id',
        'comment',
        'is_edited'
    ];

    protected $casts = [
        'is_edited' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan Comic
    public function comic()
    {
        return $this->belongsTo(Comic::class);
    }

    // Relasi untuk parent comment (untuk reply)
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Relasi untuk child comments (replies)
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')->with('user', 'replies');
    }

    // Scope untuk mendapatkan hanya parent comments (bukan reply)
    public function scopeParentOnly($query)
    {
        return $query->whereNull('parent_id');
    }

    // Scope untuk ordering berdasarkan terbaru
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}