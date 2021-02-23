<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Post $post)
    {
        $post->like();

        return back();
    }

    public function delete(Post $post)
    {
        $post->unLike();

        return back();
    }
}
