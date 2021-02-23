<?php

namespace App\Models;

use App\Trait\Likes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, Likes;

    protected $guarded = [];

    public function getPhotoAttribute($value): string
    {
        $path = str_contains($value, 'posts/')? "storage/": "storage/posts/";

        return asset($path . $value);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function commentCount(): int
    {
        return $this->comments()->count();
    }
}
