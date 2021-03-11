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
            'publications' => Publication::orderBy('id', 'desc')
                ->where('title', 'LIKE', "%$request->q%")->paginate(10),
            'q' => $request->q
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
        if ($request->user != auth()->user()->id)
            return redirect()
                ->route('user.publication.index', ['user' => auth()->user()->id])
                ->with('warning', 'You are allowed to manage only your publication.');

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
            return redirect()
                ->route('user.publication.index', ['user' => auth()->user()->id])
                ->with('warning', 'You are allowed to manage only your publication.');
        return view('publication/user-show', compact('publication'));
    }
}
