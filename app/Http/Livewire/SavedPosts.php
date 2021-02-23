<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SavedPosts extends Component
{
    public $saved;
    public int $turn;
    public int $total;

    public function mount()
    {
        $this->turn = 0;

        $this->total = auth()->user()
            ->saves()
            ->count();

        $this->saved = auth()->user()
            ->saves()
            ->offset($this->turn)
            ->limit(9)
            ->orderBy('save_post.created_at', 'desc')
            ->get();
    }

    public function loadMore()
    {
        $this->turn += 9;
        $this->saved = $this->saved->concat(
            auth()->user()
                ->saves()
                ->offset($this->turn)
                ->limit(9)
                ->orderBy('save_post.created_at', 'desc')
                ->get()
        );


    }

    public function render()
    {
        return view('livewire.saved-posts');
    }
}
