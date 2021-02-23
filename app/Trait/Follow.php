<?php

namespace App\Trait;

use App\Models\User;
use App\Models\Follow as F;

trait Follow
{
    public function follow(User $user)
    {
        return $this->follows()->save($user);
    }

    public function unFollow(User $user)
    {
        return $this->follows()->detach($user);
    }

    public function toggle(User $user)
    {
        if ($this->isFollowing($user)) {
            return $this->unFollow($user);
        }

        return $this->follow($user);
    }

    public function followerNumber(): int
    {
        return F::where("following_user_id", $this->id)->count();
    }

    public function followsNumber(): int
    {
        return $this->follows()->count();
    }

    public function isFollowing(User $user): bool
    {
        return $this->follows()
            ->where("following_user_id", $user->id)
            ->exists();
    }
}
