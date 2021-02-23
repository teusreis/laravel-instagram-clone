<?php

namespace App\Trait;

use App\Models\Post;

trait SaveTrait
{
    public function unSave(Post $post)
    {
        return $this->saves()
            ->where("post_id", $post->id)
            ->delete();
    }

    public function hasSaved(Post $post): bool
    {
        return $this->saves()
            ->where("post_id", $post->id)
            ->exists();
    }

    public function toogleSave(Post $post)
    {
        if (!$this->hasSaved($post)) {
            return $this->saves()
                ->create([
                    "post_id" => $post->id,
                ]);
        }

        return $this->unSave($post);
    }
}
