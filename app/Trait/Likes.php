<?php

namespace App\Trait;

use App\Models\User;

trait Likes
{
    public function like()
    {
        return $this->likes()->create([
            'user_id' => auth()->user()->id,
        ]);
    }

    public function unLike()
    {
        return $this->likes()->delete(auth()->user()->id);
    }

    public function toggleLike()
    {
        if ($this->isLikedBy(auth()->user())) {
            return $this->unLike();
        }

        return $this->like();
    }

    public function isLikedBy(User $user): bool
    {
        return $user->likes()
            ->where("post_id", $this->id)
            ->exists();
    }

    public function likesCount(): int
    {
        return $this->likes()->count();
    }
}
