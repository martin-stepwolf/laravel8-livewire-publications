<?php

namespace Tests\Feature;

use App\Models\Publication;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PublicationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private $url = "/publication";
    private $fillable = ['title', 'content'];
    private $columns = ['id', 'user_id', 'title', 'content', 'created_at', 'updated_at'];
    private $table = 'publications';

    public function test_index_empty()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->json('GET', $this->url);

        // TODO: check well, how Livewire works
        // $response->assertStatus(200);
        // $response->assertSee('There are not publications');
    }

    public function test_index()
    {
        $user = User::factory()->create();

        $publication = Publication::factory()->create([
            'user_id' => $user->id
        ]);
        $response = $this->actingAs($user, 'sanctum')->json('GET', $this->url);

        $response->assertStatus(200);
        $response->assertSee($publication->title);
        $response->assertSee($publication->excerpt);
    }

    public function test_store()
    {
        $user = User::factory()->create();

        // TODO: check well how I could store in livewire
        // $response = $this->actingAs($user)->post($this->url, [
        //     'title' => 'title',
        //     'content' => 'content'
        // ]);

        // $response->assertStatus(302);
        // $this->assertDatabaseHas($this->table, ['title' => 'title']);
    }

    public function test_destroy()
    {
        $user = User::factory()->create();
        $publication = Publication::factory()->create([
            'user_id' => $user->id,
            'title' => 'post to delete'
        ]);

        // TODO: check well how I could delete in livewire
        // $response = $this->actingAs($user)->delete("$this->url/{$publication->id}");

        // $response->assertStatus(302);
        // $this->assertDatabaseMissing($this->table, [
        //     'user_id' => $publication->user_id,
        //     'title' => 'post to delete'
        // ]);
    }
}
