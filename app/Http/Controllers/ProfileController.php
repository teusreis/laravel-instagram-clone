<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function index(User $user)
    {
        return view("profile.show", [
            "user" => $user
        ]);
    }

    public function edit(User $user)
    {
        return view("profile.edit", compact("user"));
    }

    public function update(User $user)
    {
        $request = $this->validProfile($user);

        if (isset($request["photo"])) {
            $request["photo"] = $request["photo"]->store("avatars");

            $data = public_path("storage/" . $request["photo"]);
            $img = Image::make($data)->fit(150, 150)->save();
        }

        $user->update($request);

        return redirect()
            ->route("profile.show", auth()->user()->username)
            ->with('flag', 'Profile updated successfully!')
            ->with("status", 'success');
    }

    private function validProfile($user)
    {
        return request()->validate([
            "name" => [
                "required",
                "string",
                "max:50"
            ],
            "username" => [
                "required",
                "string",
                " max:50",
                "alpha_dash",
                Rule::unique("users")->ignore($user)
            ],
            "description" => [
                "string",
                " max:300"
            ],
            "photo" => [
                "file"
            ]
        ]);
    }
}
