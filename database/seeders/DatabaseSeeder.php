<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();

        $users = User::all();

        $users->each(function ($user) {
            Post::factory()->count(10)->create([
                'user_id' => $user->id
            ]);
        });
    }
}
