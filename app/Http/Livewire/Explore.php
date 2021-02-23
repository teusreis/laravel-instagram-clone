<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Explore extends Component
{
    public int $turn;
    public int $total;
    public $users;

    public function mount()
    {
        $this->turn = 0;
        $this->users = auth()
            ->user()
            ->explore($this->turn, 10);
    }

    public function loadMore()
    {

    }

    public function render()
    {
        return view('livewire.explore');
    }
}
