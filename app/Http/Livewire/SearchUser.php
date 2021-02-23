<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class SearchUser extends Component
{
    public string $query;
    public int $highlight;
    public $users;

    public function mount()
    {
        $this->resetQuery();
    }

    public function updatedQuery()
    {
        if (empty($this->query)) {
            $this->users = [];
            return;
        }

        $value = "%{$this->query}%";
        $this->users = User::where("username", 'like', $value)
            ->limit(10)
            ->get()
            ->toArray();
    }

    public function increment()
    {
        if($this->highlight > count($this->users) - 1) {
            $this->highlight = 0;
            return;
        }

        $this->highlight++;
    }

    public function decrement()
    {
        if($this->highlight === count($this->users) - 1) {
        }
    }

    public function resetQuery()
    {
        $this->query = '';
        $this->highlight = 0;
        $this->users = [];
    }

    public function render()
    {
        return view('livewire.search-user');
    }
}
