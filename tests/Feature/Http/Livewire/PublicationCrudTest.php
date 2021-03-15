<?php

namespace Tests\Feature\Http\Livewire;

use App\Http\Livewire\PublicationCrud;
use App\Models\Comment;
use App\Models\Publication;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicationCrudTest extends TestCase
{
    use RefreshDatabase;
    // TODO: Implement testing about the policies in update and destroy functions

    public function test_publication_user_index_contains_publication_crud_component()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('user.publication.index', ['user' => $user->id]))
            ->assertSuccessful()
            ->assertSeeLivewire('publication-crud');
    }

    public function test_contains_user_publication()
    {
        $user = User::factory()->create();
        $publication = Publication::factory()->create([
            'user_id' => $user->id
        ]);

        $this->actingAs($user)
            ->get(route('user.publication.index', ['user' => $user->id]))
            ->assertSuccessful()
            ->assertSeeLivewire('publication-crud')
            ->assertSee($publication->title)
            ->assertSee($publication->excerpt);
    }

    public function test_can_store_publication_validation()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(PublicationCrud::class)
            ->set('title', '')
            ->set('content', '')
            ->call('store')
            ->assertHasErrors(['title', 'content']);;
    }

    public function test_can_store_publication()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(PublicationCrud::class)
            ->set('title', 'Title for the publication')
            ->set('content', 'Content for the publication')
            ->call('store');

        $this->assertDatabaseHas('publications', [
            'title' => 'Title for the publication',
            'content' => 'Content for the publication'
        ]);
    }

    public function test_can_update_publication_validation()
    {
        $user = User::factory()->create();
        $publication = Publication::factory()->create([
            'user_id' => $user->id
        ]);

        Livewire::actingAs($user)
            ->test(PublicationCrud::class)
            ->set('title', '')
            ->set('content', '')
            ->call('update')
            ->assertHasErrors(['title', 'content']);
    }

    public function test_can_update_publication()
    {
        $user = User::factory()->create();
        $publication = Publication::factory()->create([
            'user_id' => $user->id
        ]);

        Livewire::actingAs($user)
            ->test(PublicationCrud::class)
            ->set('publication_id', $publication->id)
            ->set('title', 'New title for the publication')
            ->set('content', 'New content for the publication')
            ->call('update');

        $this->assertDatabaseHas('publications', [
            'title' => 'New title for the publication',
            'content' => 'New content for the publication'
        ]);
    }

    public function test_can_delete_publication()
    {
        $user = User::factory()->create();
        $publication = Publication::factory()->create([
            'user_id' => $user->id,
            'title' => 'Publication to delete'
        ]);

        Livewire::actingAs($user)
            ->test(PublicationCrud::class)
            ->call('destroy', $publication->id);

        $this->assertDatabaseMissing('publications', [
            'title' => 'Publication to delete'
        ]);
    }

    public function test_can_delete_publication_with_comments()
    {
        $this->artisan('db:seed', ['--class' => 'CommentStateSeeder']);
        $user = User::factory()->create();
        $publication = Publication::factory()->create([
            'user_id' => $user->id,
            'title' => 'Publication to delete'
        ]);
        Comment::factory()->create([
            'user_id' => $user->id,
            'publication_id' => $publication->id,
            'comment_state_id' => 2,
            'content' => 'Comment to delete also'
        ]);

        Livewire::actingAs($user)
            ->test(PublicationCrud::class)
            ->call('destroy', $publication->id);

        $this->assertDatabaseMissing('publications', ['title' => 'Publication to delete'])
            ->assertDatabaseMissing('comments', ['content' => 'Comment to delete also']);
    }
}
