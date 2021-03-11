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
        $this->call(CommentStateSeeder::class);

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com'
        ]);
        \App\Models\User::factory(29)->create();

        // data to test a particular comment 
        $this->call(CommentTestSeeder::class);
        \App\Models\Publication::factory(20)->create(['user_id' => 1]);

        \App\Models\Publication::factory(29)->create();

        \App\Models\Comment::factory(1000)->create();
    }
}
