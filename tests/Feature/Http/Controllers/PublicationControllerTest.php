<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Publication;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PublicationControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    // TODO: Add test to search function

    public function test_index_empty()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->get('/publications');

        $response->assertStatus(200);
        $response->assertSee('There are not publications');
    }

    public function test_index()
    {
        $user = User::factory()->create();
        $publication = Publication::factory()->create([
            'user_id' => $user->id
        ]);

        $response = $this->actingAs($user, 'sanctum')->get('/publications');

        $response->assertStatus(200);
        $response->assertSee($publication->title);
        $response->assertSee($publication->excerpt);
    }

    public function test_show()
    {
        $user = User::factory()->create();
        $publication = Publication::factory()->create([
            'user_id' => $user->id
        ]);

        $response = $this->actingAs($user, 'sanctum')->get("/publications/$publication->id");

        $response->assertStatus(200);
        $response->assertSee($publication->title);
        $response->assertSee($publication->content);
    }

    public function test_user_index_empty()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->get("/users/$user->id/publications");

        $response->assertStatus(200);
        $response->assertSee('There are not publications');
    }

    public function test_user_index_policy()
    {
        $user = User::factory()->create();
        $publication = Publication::factory()->create([
            'user_id' => $user->id
        ]);

        $user_malicious = User::factory()->create();
        $response = $this->actingAs($user_malicious, 'sanctum')->get("/users/$user->id/publications");

        $response->assertStatus(302);
    }

    public function test_user_index()
    {
        $user = User::factory()->create();
        $publication = Publication::factory()->create([
            'user_id' => $user->id
        ]);

        $response = $this->actingAs($user, 'sanctum')->get("/users/$user->id/publications");

        $response->assertStatus(200);
        $response->assertSee($publication->title);
        $response->assertSee($publication->excerpt);
    }

    public function test_user_show_policy()
    {
        $user = User::factory()->create();
        $publication = Publication::factory()->create([
            'user_id' => $user->id
        ]);

        $user_malicious = User::factory()->create();
        $response = $this->actingAs($user_malicious, 'sanctum')->get("/users/$user->id/publications/$publication->id");

        $response->assertStatus(302);
    }

    public function test_user_show()
    {
        $user = User::factory()->create();
        $publication = Publication::factory()->create([
            'user_id' => $user->id
        ]);

        $response = $this->actingAs($user, 'sanctum')->get("/users/$user->id/publications/$publication->id");

        $response->assertStatus(200);
        $response->assertSee($publication->title);
        $response->assertSee($publication->content);
    }
}