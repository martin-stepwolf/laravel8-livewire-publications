<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        auth()->user()->comments()->create($request->all() + [
            'publication_id' => $request->publication,
            'comment_state_id' => 1
        ]);

        return back();
    }
}
