<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Publication;
use Illuminate\Database\Seeder;

class CommentTestSeeder extends Seeder
{
    public function run()
    {
        // A publication is created with some comments 
        for ($i = 1; $i <= 1; $i++) {
            $publication = Publication::factory()->create([
                'user_id' => 1
            ]);
            // One comment is waiting
            for ($i = 1; $i <= 1; $i++)
                Comment::factory()->create([
                    'publication_id' => $publication->id,
                    'comment_state_id' => 1
                ]);
            // Two comments are approved
            for ($i = 1; $i <= 2; $i++)
                Comment::factory()->create([
                    'publication_id' => $publication->id,
                    'comment_state_id' => 2
                ]);
            // Three comments are rejected
            for ($i = 1; $i <= 3; $i++)
                Comment::factory()->create([
                    'publication_id' => $publication->id,
                    'comment_state_id' => 3
                ]);
        }
    }
}
