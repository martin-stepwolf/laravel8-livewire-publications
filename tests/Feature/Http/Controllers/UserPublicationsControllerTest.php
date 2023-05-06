<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Publication;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserPublicationsControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private User $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed', ['--class' => 'CommentStateSeeder']);

        $this->user = User::factory()->create();

        $this->actingAs($this->user, 'sanctum');
    }

    public function test_index_policy()
    {
        $otherUser = User::factory()->create();
        Publication::factory()->user($otherUser)->create();

        $this->get("/users/$otherUser->id/publications")
            ->assertStatus(302);
    }

    public function test_index()
    {
        $publication = Publication::factory()->user($this->user)->create();

        $this->get("/users/{$this->user->id}/publications")
            ->assertStatus(200)
            ->assertSee($publication->title)
            ->assertSee($publication->excerpt);
    }

    public function test_show_policy()
    {
        $otherUser = User::factory()->create();
        $publication = Publication::factory()->user($otherUser)->create();

        $this->get("/users/$otherUser->id/publications/$publication->id")
            ->assertStatus(302);
    }

    public function test_show()
    {
        $publication = Publication::factory()->user($this->user)->create();

        $this->get("/users/{$this->user->id}/publications/$publication->id")
            ->assertStatus(200)
            ->assertSee($publication->title)
            ->assertSee($publication->content);
    }
}
