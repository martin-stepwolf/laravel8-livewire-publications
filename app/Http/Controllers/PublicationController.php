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
        return view('publication/index', [
            'publications' => Publication::orderBy('id', 'desc')->paginate()
        ]);
    }

    public function show(Publication $publication)
    {
        $has_commented = false;
        if ($publication->comments->where('user_id', auth()->user()->id)->count() !== 0)
            $has_commented = true;

        return view('publication/show', compact('publication') +  compact('has_commented') + [
            'comments' => $publication->comments->where('comment_state_id', 2),
        ]);
    }

    public function user_index(Request $request)
    {
        // TODO: Implement a validation for urls from no owners
        // if ($request->user()->id !== $request->user)
        //     // TODO: show a flash message about this is a unauthorized action
        //     return back();
        return view('publication/user-index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function user_show(Request $request)
    {
        $publication = Publication::findOrFail($request->id);
        if ($request->user()->id !== $publication->user_id)
            // TODO: show a flash message about this is a unauthorized action
            return back();
        return view('publication/user-show', compact('publication'));
    }
}
