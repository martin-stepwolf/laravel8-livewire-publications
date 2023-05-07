<?php

namespace Tests\Feature\Http\Livewire;

use App\Http\Livewire\CommentsApprobation;
use App\Models\Comment;
use App\Models\Publication;
use App\Models\User;
use App\States\Comment\Approved;
use App\States\Comment\Pending;
use App\States\Comment\Rejected;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CommentsApprobationTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->actingAs($this->user);
    }

    public function test_user_show_contains_comments_approbation_component()
    {
        $publication = Publication::factory()->user($this->user)->create();

        $this->get(route('user.publication.show', [
            'user' => $this->user->id,
            'id' => $publication->id,
        ]))
            ->assertSuccessful()
            ->assertSeeLivewire('comments-approbation');
    }

    public function test_contains_on_hold_comment()
    {
        $publication = Publication::factory()->user($this->user)->create();

        $user = User::factory()->create();
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'publication_id' => $publication->id,
        ]);

        $this->get(route('user.publication.show', ['user' => $this->user->id, 'id' => $publication->id]))
            ->assertSuccessful()
            ->assertSeeLivewire('comments-approbation')
            ->assertSee($comment->content)
            ->assertSee($comment->user->name);
    }

    public function test_comment_can_be_approved()
    {
        $publication = Publication::factory()->user($this->user)->create();

        $user = User::factory()->create();
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'publication_id' => $publication->id,
        ]);

        Livewire::actingAs($this->user)
            ->test(CommentsApprobation::class)
            ->set('publication_id', $publication->id)
            ->call('approve', $comment->id);

        $this->assertDatabaseHas('comments', [
            'content' => $comment->content,
            'state' => Approved::$name,
        ]);
    }

    public function test_comment_can_be_rejected()
    {
        $publication = Publication::factory()->user($this->user)->create();

        $user = User::factory()->create();
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'publication_id' => $publication->id,
        ]);

        Livewire::actingAs($this->user)
            ->test(CommentsApprobation::class)
            ->set('publication_id', $publication->id)
            ->call('reject', $comment->id);

        $this->assertDatabaseHas('comments', [
            'content' => $comment->content,
            'state' => Rejected::$name,
        ]);
    }
}
