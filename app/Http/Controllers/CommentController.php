<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Post $post)
    {

        $request = request()->validate([
            "comment" => ['required', 'max:200'],
        ]);

        $post->comments()->create([
            "comment" => $request['comment'],
            'user_id' => auth()->id()
        ]);

        return redirect()
            ->route("post.show", $post->id);
    }

    public function delete(Comment $comment)
    {
        $comment->delete();

        return back();
    }

}
