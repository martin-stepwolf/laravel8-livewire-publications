<?php

namespace Tests\Unit\Models;

use App\Models\Comment;
use App\Models\Publication;
use App\Models\User;
use App\States\Comment\CommentState;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_has_a_comment_state()
    {
        $comment = Comment::factory()->approved()->create([
            'user_id' => User::factory()->create(),
            'publication_id' => Publication::factory()->create(['user_id' => User::factory()->create()]),
        ]);

        $this->assertInstanceOf(CommentState::class, $comment->state);
    }

    public function test_has_a_user()
    {
        $comment = Comment::factory()->approved()->create([
            'user_id' => User::factory()->create(),
            'publication_id' => Publication::factory()->create(['user_id' => User::factory()->create()]),
        ]);

        $this->assertInstanceOf(User::class, $comment->user);
    }

    public function test_has_a_publication()
    {
        $comment = Comment::factory()->approved()->create([
            'user_id' => User::factory()->create(),
            'publication_id' => Publication::factory()->create(['user_id' => User::factory()->create()]),
        ]);

        $this->assertInstanceOf(Publication::class, $comment->publication);
    }
}
