<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;

class TimelineComment extends Component
{
    public Post $post;
    public $comments;
    public string $comment;
    public int $commentsNumber;

    protected $rules = [
        'comment' => ['required', 'max:200']
    ];

    public function mount()
    {
        $this->commentsNumber = $this->post
            ->comments()
            ->count();

        $this->resetProp();
    }

    public function submit()
    {
        $this->validate();

        $this->post->comments()->create([
            'comment' => $this->comment,
            'user_id' => auth()->id(),
        ]);

        $this->resetProp();
    }

    public function resetProp()
    {
        $this->comment = "";
        $this->comments = $this->post
            ->comments()
            ->latest()
            ->limit(2)
            ->get();
    }

    public function render()
    {
        return view('livewire.timeline-comment');
    }
}
