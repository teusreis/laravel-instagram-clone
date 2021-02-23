<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SaveController extends Controller
{
    public function index()
    {
        return view("save.index");
    }

    public function store(Post $post)
    {

        auth()->user()
            ->saves()
            ->create([
                "post_id" => $post->id,
            ]);

        return back();
    }

    public function delete(Post $post)
    {
        auth()->user()
            ->unSave($post);

        return back();
    }
}
