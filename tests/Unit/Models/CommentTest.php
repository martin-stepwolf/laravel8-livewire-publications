<?php

namespace Tests\Unit\Models;

use App\Models\Comment;
use App\Models\CommentState;
use App\Models\Publication;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_has_a_comment_state()
    {
        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create(),
            'publication_id' => Publication::factory()->create(['user_id' => User::factory()->create()]),
            'comment_state_id' => CommentState::create(['title' => 'approved']),
        ]);

        $this->assertInstanceOf(CommentState::class, $comment->comment_state);
    }

    public function test_has_a_user()
    {
        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create(),
            'publication_id' => Publication::factory()->create(['user_id' => User::factory()->create()]),
            'comment_state_id' => CommentState::create(['title' => 'approved']),
        ]);

        $this->assertInstanceOf(User::class, $comment->user);
    }

    public function test_has_a_publication()
    {
        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create(),
            'publication_id' => Publication::factory()->create(['user_id' => User::factory()->create()]),
            'comment_state_id' => CommentState::create(['title' => 'approved']),
        ]);

        $this->assertInstanceOf(Publication::class, $comment->publication);
    }
}
