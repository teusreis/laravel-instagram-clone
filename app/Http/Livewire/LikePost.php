<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class LikePost extends Component
{
    public Post $post;

    public function submit()
    {
        $this->post
            ->toggleLike($this->post);
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
