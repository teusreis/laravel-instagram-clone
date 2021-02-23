<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function show(Post $post)
    {
        return view("post.show", compact("post"));
    }

    public function create()
    {
        return view("post.create");
    }

    public function store()
    {
        $request = $this->validatePost();

        auth()->user()->posts()->create([
            "photo" => $request["photo"],
            "description" => $request["description"]
        ]);

        return redirect()
            ->route("profile.show", auth()->user()->username)
            ->with("flag", "Post created successfully")
            ->with("status", "success");
    }

    public function edit(Post $post)
    {
        $this->authorize("update", $post);

        return view("post.edit", compact("post"));
    }

    public function update(Post $post)
    {
        $this->authorize("update", $post);

        $request = request()->validate([
            "description" => ["required", "string", "max:300"],
        ]);

        $post->update($request);

        return redirect()
            ->route("post.show", $post->id)
            ->with("flag", "Post updated successfully")
            ->with("status", "success");
    }

    public function delete(Post $post)
    {
        $this->authorize("delete", $post);

        $post->delete();

        return redirect()
            ->route("profile.show", auth()->user()->username)
            ->with("flag", "Post deleted successfully")
            ->with("status", "success");
    }

    private function validatePost()
    {
        $request = request()->validate([
            "photo" => ["sometimes", "file"],
            "description" => ["required", "string", "max:300"],
        ]);

        if ($request["photo"]) {
            $request["photo"] = $request["photo"]->store("posts");
            Image::make(public_path("storage/" . $request["photo"]))->fit(500, 500)->save();
        }

        return $request;
    }
}
