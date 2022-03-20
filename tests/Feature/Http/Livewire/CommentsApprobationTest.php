<?php

namespace Tests\Feature\Http\Livewire;

use App\Http\Livewire\CommentsApprobation;
use App\Models\Comment;
use App\Models\Publication;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CommentsApprobationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_show_contains_comments_approbation_component()
    {
        $user = User::factory()->create();
        $publication = Publication::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->actingAs($user)
            ->get(route('user.publication.show', ['user' => $user->id, 'id' => $publication->id]))
            ->assertSuccessful()
            ->assertSeeLivewire('comments-approbation');
    }

    public function test_contains_on_hold_comment()
    {
        $this->artisan('db:seed', ['--class' => 'CommentStateSeeder']);
        $user = User::factory()->create();
        $publication = Publication::factory()->create([
            'user_id' => $user->id,
        ]);

        $user_comment = User::factory()->create();
        $comment = Comment::factory()->create([
            'user_id' => $user_comment->id,
            'publication_id' => $publication->id,
            'comment_state_id' => 1,
        ]);

        $this->actingAs($user)
            ->get(route('user.publication.show', ['user' => $user->id, 'id' => $publication->id]))
            ->assertSuccessful()
            ->assertSeeLivewire('comments-approbation')
            ->assertSee($comment->content)
            ->assertSee($comment->user->name);
    }

    public function test_comment_can_be_approved()
    {
        $this->artisan('db:seed', ['--class' => 'CommentStateSeeder']);
        $user = User::factory()->create();
        $publication = Publication::factory()->create([
            'user_id' => $user->id,
        ]);

        $user_comment = User::factory()->create();
        $comment = Comment::factory()->create([
            'user_id' => $user_comment->id,
            'publication_id' => $publication->id,
            'comment_state_id' => 1,
        ]);

        Livewire::actingAs($user)
            ->test(CommentsApprobation::class)
            ->set('publication_id', $publication->id)
            ->call('approve', $comment->id);

        $this->assertDatabaseHas('comments', [
            'content' => $comment->content,
            'comment_state_id' => 2,
        ]);
    }

    public function test_comment_can_be_rejected()
    {
        $this->artisan('db:seed', ['--class' => 'CommentStateSeeder']);
        $user = User::factory()->create();
        $publication = Publication::factory()->create([
            'user_id' => $user->id,
        ]);

        $user_comment = User::factory()->create();
        $comment = Comment::factory()->create([
            'user_id' => $user_comment->id,
            'publication_id' => $publication->id,
            'comment_state_id' => 1,
        ]);

        Livewire::actingAs($user)
            ->test(CommentsApprobation::class)
            ->set('publication_id', $publication->id)
            ->call('reject', $comment->id);

        $this->assertDatabaseHas('comments', [
            'content' => $comment->content,
            'comment_state_id' => 3,
        ]);
    }
}
