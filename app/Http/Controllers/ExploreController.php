<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function index()
    {
        return view('explore.index', [
            "users" => auth()
                ->user()
                ->explore(limit: 30),
        ]);
    }
}
