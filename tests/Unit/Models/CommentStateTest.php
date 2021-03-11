<?php

namespace Tests\Unit\Models;

use App\Models\CommentState;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;

class CommentStateTest extends TestCase
{
    public function test_has_many_comments()
    {
        $comment_state = new CommentState();

        $this->assertInstanceOf(Collection::class, $comment_state->comments);
    }
}
