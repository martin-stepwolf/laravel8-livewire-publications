<?php

namespace Database\Seeders;

use App\Models\CommentState;
use Illuminate\Database\Seeder;

class CommentStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CommentState::create(['title' => 'on hold']);
        CommentState::create(['title' => 'approved']);
        CommentState::create(['title' => 'rejected']);
    }
}
