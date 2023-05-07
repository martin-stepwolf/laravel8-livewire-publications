<?php

namespace Tests\Feature\Http\Livewire;

use App\Models\Comment;
use App\Models\Publication;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicationCommentsTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->actingAs($this->user);
    }

    public function test_publication_show_contains_publication_comments_component()
    {
        $publication = Publication::factory()->user($this->user)->create();

        $this->get(route('publication.show', $publication))
            ->assertSuccessful()
            ->assertSeeLivewire('publication-comments');
    }

    public function test_user_show_contains_comments_approbation_component()
    {
        $publication = Publication::factory()->user($this->user)->create();

        $this->get(route('user.publication.show', ['user' => $this->user->id, 'id' => $publication->id]))
            ->assertSuccessful()
            ->assertSeeLivewire('publication-comments');
    }

    public function test_contains_approved_comment()
    {
        $publication = Publication::factory()->user($this->user)->create();
        $comment = Comment::factory()->approved()->create([
            'user_id' => $this->user->id,
            'publication_id' => $publication->id,
        ]);

        $this->get(route('publication.show', $publication))
            ->assertSuccessful()
            ->assertSeeLivewire('publication-comments')
            ->assertSee($comment->content)
            ->assertSee($comment->user->name);

        $this->get(route('user.publication.show', ['user' => $this->user->id, 'id' => $publication->id]))
            ->assertSuccessful()
            ->assertSeeLivewire('publication-comments')
            ->assertSee($comment->content)
            ->assertSee($comment->user->name);
    }
}
