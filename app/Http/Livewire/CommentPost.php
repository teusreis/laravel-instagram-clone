<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CommentPost extends Component
{
    public int $turn;
    public int $total;
    public $post;
    public $comments;
    public string $comment;

    protected $rules = [
        'comment' => ['required', 'max:200'],
    ];

    public function mount()
    {
        $this->resetComments();
    }

    public function readMore()
    {
        $this->turn += 5;
        $this->comments = $this->comments->concat(
            $this->post
                ->comments()
                ->offset($this->turn)
                ->limit(5)
                ->latest()
                ->get(),
        );
    }

    public function submit()
    {
        $this->validate();

        $this->post
            ->comments()
            ->create([
                "comment" => $this->comment,
                "user_id" => auth()->id()
            ]);

        $this->resetComments();
    }

    private function resetComments()
    {
        $this->comment = "";
        $this->turn = 0;

        $this->total = $this->post
            ->comments()
            ->count();

        $this->comments = $this->post
            ->comments()
            ->offset($this->turn)
            ->limit(5)
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.comment-post');
    }
}
