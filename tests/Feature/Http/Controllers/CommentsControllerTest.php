<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Publication;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentsControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    private Publication $publication;

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed', ['--class' => 'CommentStateSeeder']);

        $this->user = User::factory()->create();

        $this->publication = Publication::factory()->user($this->user)->create();

        $this->actingAs($this->user);
    }

    public function test_validate_store()
    {
        $this->post("publications/{$this->publication->id}/comments/store", [
            'content' => '',
        ])->assertSessionHasErrors(['content'])
        ->assertStatus(302);
    }

    public function test_store()
    {
        $this->post("publications/{$this->publication->id}/comments/store", [
            'content' => 'A great publication, you know how to make a great one.',
        ])->assertStatus(302);

        $this->assertDatabaseHas('comments', [
            'content' => 'A great publication, you know how to make a great one.',
            'user_id' => $this->user->getKey(),
            'publication_id' => $this->publication->getKey(),
        ]);
    }
}
