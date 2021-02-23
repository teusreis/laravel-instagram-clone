<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Timeline extends Component
{
    public int $limit;
    public int $turn;
    public $posts;

    protected $listeners = [
        "renderMore" => "renderMore",
    ];

    public function mount()
    {
        $this->turn = 0;
        $this->limit = 10;
        $this->posts = auth()->user()->timeline($this->turn, $this->limit);
    }

    public function renderMore()
    {
        $this->turn += 10;
        $this->posts = $this->posts
            ->concat(auth()->user()->timeline($this->turn, $this->limit));
    }

    public function render()
    {
        return view('livewire.timeline');
    }
}
