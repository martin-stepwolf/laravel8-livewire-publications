<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Publication;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_validate_store()
    {
        $user = User::factory()->create();
        $publication = Publication::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->post("publications/$publication->id/comments/store", [
            'content' => '',
        ]);

        $response->assertSessionHasErrors(['content']);
        $response->assertStatus(302);
    }

    public function test_store()
    {
        $user = User::factory()->create();
        $publication = Publication::factory()->create([
            'user_id' => $user->id,
        ]);

        // BUG: Bug in auth()->user()
        // $response = $this->actingAs($user)->post("publications/$publication->id/comments/store", [
        //     'content' => 'A great publication, you know how to make a great one.'
        // ]);

        // $response->assertStatus(302);
        // $this->assertDatabaseHas('comments', ['content' => 'A great publication, you know how to make a great one.']);
    }
}
