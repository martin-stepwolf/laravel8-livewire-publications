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

    public function test_publication_show_contains_publication_comments_component()
    {
        $user = User::factory()->create();
        $publication = Publication::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->actingAs($user)
            ->get(route('publication.show', $publication))
            ->assertSuccessful()
            ->assertSeeLivewire('publication-comments');
    }

    public function test_user_show_contains_comments_approbation_component()
    {
        $user = User::factory()->create();
        $publication = Publication::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->actingAs($user)
            ->get(route('user.publication.show', ['user' => $user->id, 'id' => $publication->id]))
            ->assertSuccessful()
            ->assertSeeLivewire('publication-comments');
    }

    public function test_contains_approved_comment()
    {
        $this->artisan('db:seed', ['--class' => 'CommentStateSeeder']);
        $user = User::factory()->create();
        $publication = Publication::factory()->create([
            'user_id' => $user->id,
        ]);
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'publication_id' => $publication->id,
            'comment_state_id' => 2,
        ]);

        $this->actingAs($user)
            ->get(route('publication.show', $publication))
            ->assertSuccessful()
            ->assertSeeLivewire('publication-comments')
            ->assertSee($comment->content)
            ->assertSee($comment->user->name);

        $this->actingAs($user)
            ->get(route('user.publication.show', ['user' => $user->id, 'id' => $publication->id]))
            ->assertSuccessful()
            ->assertSeeLivewire('publication-comments')
            ->assertSee($comment->content)
            ->assertSee($comment->user->name);
    }
}
