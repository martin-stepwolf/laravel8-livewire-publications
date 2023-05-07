<?php

namespace Tests\Unit\Models;

use App\Models\Comment;
use App\Models\Publication;
use App\Models\User;
use App\States\Comment\Approved;
use App\States\Comment\Pending;
use App\States\Comment\Rejected;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\ModelStates\Exceptions\TransitionNotFound;
use Tests\TestCase;

class CommentStateTest extends TestCase
{
    use RefreshDatabase;

    private Comment $comment;

    public function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        $publication = Publication::factory()->user($user)->create();

        $this->comment = new Comment();
        $this->comment->user()->associate($user);
        $this->comment->publication()->associate($publication);
        $this->comment->content = 'Content comment';
        $this->comment->save();
    }

    public function test_comment_is_saved_as_pending()
    {
        $this->assertTrue($this->comment->state->equals(Pending::class));
    }

    public function test_comment_can_transition_from_pending_to_approved()
    {
        $this->comment->state->transitionTo(Approved::class);

        $this->assertTrue($this->comment->state->equals(Approved::class));
    }

    public function test_comment_can_transition_from_pending_to_rejected()
    {
        $this->comment->state->transitionTo(Rejected::class);

        $this->assertTrue($this->comment->state->equals(Rejected::class));
    }

    public function test_comment_can_transition_from_approved_to_pending()
    {
        $this->expectException(TransitionNotFound::class);

        $this->comment->state->transitionTo(Approved::class);
        $this->comment->state->transitionTo(Pending::class);

        $this->assertTrue($this->comment->state->equals(Approved::class));
    }

    public function test_comment_can_transition_from_approved_to_rejected()
    {
        $this->expectException(TransitionNotFound::class);

        $this->comment->state->transitionTo(Rejected::class);
        $this->comment->state->transitionTo(Pending::class);

        $this->assertTrue($this->comment->state->equals(Rejected::class));
    }
}
