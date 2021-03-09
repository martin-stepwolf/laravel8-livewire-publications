<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // TODO: Implement a validation for urls from no owners
        // if ($request->user()->id !== $request->user)
        //     // TODO: show a flash message about this is a unauthorized action
        //     return back();
        return view('publication/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $publication = Publication::findOrFail($request->id);
        if ($request->user()->id !== $publication->user_id)
            // TODO: show a flash message about this is a unauthorized action
            return back();
        return view('publication/show', compact('publication'));
    }
}
