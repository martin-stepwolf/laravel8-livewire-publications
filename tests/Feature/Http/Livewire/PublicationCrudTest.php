<?php

namespace Tests\Feature\Http\Livewire;

use App\Http\Livewire\PublicationCrud;
use App\Models\Comment;
use App\Models\Publication;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PublicationCrudTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->actingAs($this->user);
    }

    // TODO: Implement testing about the policies in update and destroy functions

    public function test_publication_user_index_contains_publication_crud_component()
    {
        $this->get(route('user.publication.index', ['user' => $this->user->id]))
            ->assertSuccessful()
            ->assertSeeLivewire('publication-crud');
    }

    public function test_contains_user_publication()
    {
        $publication = Publication::factory()->user($this->user)->create();

        $this->get(route('user.publication.index', ['user' => $this->user->id]))
            ->assertSuccessful()
            ->assertSeeLivewire('publication-crud')
            ->assertSee($publication->title)
            ->assertSee($publication->excerpt);
    }

    public function test_can_store_publication_validation()
    {
        Livewire::actingAs($this->user)
            ->test(PublicationCrud::class)
            ->set('title', '')
            ->set('content', '')
            ->call('store')
            ->assertHasErrors(['title', 'content']);
    }

    public function test_can_store_publication()
    {
        Livewire::actingAs($this->user)
            ->test(PublicationCrud::class)
            ->set('title', 'Title for the publication')
            ->set('content', 'Content for the publication')
            ->call('store');

        $this->assertDatabaseHas('publications', [
            'title' => 'Title for the publication',
            'content' => 'Content for the publication',
        ]);
    }

    public function test_can_update_publication_validation()
    {
        $publication = Publication::factory()->user($this->user)->create();

        Livewire::actingAs($this->user)
            ->test(PublicationCrud::class)
            ->set('title', '')
            ->set('content', '')
            ->call('update')
            ->assertHasErrors(['title', 'content']);
    }

    public function test_can_update_publication()
    {
        $publication = Publication::factory()->user($this->user)->create();

        Livewire::actingAs($this->user)
            ->test(PublicationCrud::class)
            ->set('publication_id', $publication->id)
            ->set('title', 'New title for the publication')
            ->set('content', 'New content for the publication')
            ->call('update');

        $this->assertDatabaseHas('publications', [
            'title' => 'New title for the publication',
            'content' => 'New content for the publication',
        ]);
    }

    public function test_can_delete_publication()
    {
        $publication = Publication::factory()->user($this->user)->create([
            'title' => 'Publication to delete',
        ]);

        Livewire::actingAs($this->user)
            ->test(PublicationCrud::class)
            ->call('destroy', $publication->id);

        $this->assertDatabaseMissing('publications', [
            'title' => 'Publication to delete',
        ]);
    }

    public function test_can_delete_publication_with_comments()
    {
        $publication = Publication::factory()->user($this->user)->create([
            'title' => 'Publication to delete',
        ]);
        Comment::factory()->approved()->create([
            'user_id' => $this->user->id,
            'publication_id' => $publication->id,
            'content' => 'Comment to delete also',
        ]);

        Livewire::actingAs($this->user)
            ->test(PublicationCrud::class)
            ->call('destroy', $publication->id);

        $this->assertDatabaseMissing('publications', ['title' => 'Publication to delete'])
            ->assertDatabaseMissing('comments', ['content' => 'Comment to delete also']);
    }
}
