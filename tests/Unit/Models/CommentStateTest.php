<?php

namespace Tests\Unit\Models;

use App\Models\Comment;
use App\Models\CommentState;
use App\Models\User;
use App\Models\Publication;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class CommentStateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    // TODO: some errors in Models and create more test
    // public function test_belongs_to_user()
    // {
    //     $comment = Comment::factory()->create([
    //         'user_id' => User::factory()->create(),
    //         'publication_id' => Publication::factory()->create(),
    //         'comment_state_id' => CommentState::create(['title' => 'rejected'])
    //     ]);

    //     // $this->assertInstanceOf(Collection::class, $comment->user);
    // }
}
