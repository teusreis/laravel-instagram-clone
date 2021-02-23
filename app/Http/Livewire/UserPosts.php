<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class UserPosts extends Component
{
    public $userId;
    public $posts;
    public int $turn;
    public int $total;

    public function mount()
    {
        $this->turn = 0;
        $this->total = Post::where("user_id", $this->userId)->count();


        $this->posts = Post::where("user_id", $this->userId)
        ->offset($this->turn)
        ->limit(9)
        ->latest()
        ->get();
    }

    public function loadMore()
    {
        $this->turn += 9;
        $this->posts = $this->posts->concat(
            Post::where("user_id", $this->userId)
                ->offset($this->turn)
                ->limit(9)
                ->latest()
                ->get()
        );
    }

    public function render()
    {
        return view('livewire.user-posts');
    }
}
