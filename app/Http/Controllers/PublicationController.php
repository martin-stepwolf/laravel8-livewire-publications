<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    private $q;

    public function index(Request $request)
    {
        $this->q = $request->q;

        return view('publication/index', [
            'publications' => Publication::where(function ($query) {
                $query->where('title', 'LIKE', "%{$this->q}%")
                    ->orWhere('content', 'LIKE', "%{$this->q}%");
            })->orderBy('created_at', 'desc')->paginate(8),
            'q' => $this->q
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

    public function user_show(Request $request)
    {
        $publication = Publication::findOrFail($request->id);
        if ($request->user()->id != $publication->user_id)
            return redirect()
                ->route('user.publication.index', ['user' => auth()->user()->id])
                ->with('warning', 'You are allowed to manage only your publication.');
        return view('publication/user-show', compact('publication'));
    }
}
