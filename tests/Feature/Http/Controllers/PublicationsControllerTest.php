<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Publication;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PublicationsControllerTest extends TestCase
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

    public function test_index_empty()
    {
        $this->get('/publications')
            ->assertStatus(200)
            ->assertSee('There are not publications');
    }

    public function test_index_search()
    {
        Publication::factory(16)->user($this->user)->create();
        $publication = Publication::factory()->user($this->user)->create();

        $this->get("/publications/?q=$publication->title")
            ->assertStatus(200)
            ->assertSee($publication->title);

        // Note: the controller search by all the content, not just for excerpt
        $this->get("/publications/?q=$publication->excerpt")
            ->assertStatus(200)
            ->assertSee($publication->excerpt);
    }

    public function test_index()
    {
        $publication = Publication::factory()->user($this->user)->create();

        $this->get('/publications')
            ->assertStatus(200)
            ->assertSee($publication->title)
            ->assertSee($publication->excerpt);
    }

    public function test_show()
    {
        $publication = Publication::factory()->user($this->user)->create();

        $this->get("/publications/$publication->slug")
           ->assertStatus(200)
           ->assertSee($publication->title)
           ->assertSee($publication->content);
    }
}
