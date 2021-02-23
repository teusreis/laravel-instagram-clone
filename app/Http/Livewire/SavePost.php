<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class SavePost extends Component
{
    public Post $post;

    public function submit()
    {
        auth()->user()
            ->toogleSave($this->post);
    }

    public function render()
    {
        return view('livewire.save-post');
    }
}
