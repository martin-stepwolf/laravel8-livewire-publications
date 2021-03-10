<?php

namespace Database\Seeders;

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
        \App\Models\User::factory(10)->create();
        \App\Models\Publication::factory(100)->create();
        $this->call(CommentStateSeeder::class);
        \App\Models\Comment::factory(1000)->create();

        // data to test the app from a user 
        $this->call(UserTestSeeder::class);
    }
}
