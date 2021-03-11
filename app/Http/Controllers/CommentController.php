<?php

namespace App\Http\Controllers;

use App\Events\NewComment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|min:15|max:255',
        ]);

        $comment = auth()->user()->comments()->create($request->all() + [
            'publication_id' => $request->publication,
            'comment_state_id' => 1
        ]);

        // If the user is the author, the email is not and the comment is approved 
        if (auth()->user()->id == $comment->publication->user_id) {
            $comment->update(['comment_state_id' => 2]);
            return back()->with('message', 'Your comment was created successfully.');
        }

        event(new NewComment(auth()->user(), $comment));

        return back()->with('message', 'Your comment was created successfully, wait for a approbation by the owner.');
    }
}
