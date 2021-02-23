<?php

namespace App\Models;

use App\Trait\Follow;
use App\Trait\SaveTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Follow, SaveTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'description',
        'photo',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getPhotoAttribute($value)
    {
        if ($value) {
            $path = asset("storage/" . $value);
        } else {
            $path = asset("img/default-avatar.png");
        }

        return $path;
    }

    public function timeline($offset = 0, $limit = null)
    {
        $ids = $this->follows()->pluck("id");
        $ids->push($this->id);

        $limit = $limit ?? Post::whereIn("user_id", $ids)->count();

        return Post::whereIn("user_id", $ids)
            ->offset($offset)
            ->limit($limit)
            ->latest()
            ->get();
    }

    public function explore($offset = 0, $limit = null)
    {
        $ids = $this->follows()->pluck("id");
        $ids->push($this->id);

        $limit = $limit ?? User::whereNotIn("id")->count();

        return User::whereNotIn("id", $ids)
            ->offset($offset)
            ->limit($limit)
            ->latest()
            ->get();
    }

    public function postsNumber(): int
    {
        return $this->posts()->count();
    }

    // Relationships
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function follows()
    {
        return $this->belongsToMany(User::class, "follows", "user_id", "following_user_id");
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function saves()
    {
        return $this->hasMany(Save::class);
    }
}
