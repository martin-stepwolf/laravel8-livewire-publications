<?php

namespace App\Http\Controllers;

use App\Events\NewComment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = auth()->user()->comments()->create($request->all() + [
            'publication_id' => $request->publication,
            'comment_state_id' => 1
        ]);

        // If the user is not the author of the publication, an email is sent 
        if (auth()->user()->id != $comment->publication->user_id)
            event(new NewComment(auth()->user(), $comment));

        return back()->with('message', 'Your comment was created successfully, wait for a approbation by the owner.');
    }
}
