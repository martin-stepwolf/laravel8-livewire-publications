<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicationController extends Controller
{
    public function index(Request $request)
    {
        $publications = Publication::query()
            ->where('title', 'LIKE', "%{$request->input('q')}%")
            ->orWhere('content', 'LIKE', "%{$request->input('q')}%")
            ->orderBy('created_at', 'desc')
            ->paginate(8);

        // If there are some value in the search it is added to the links
        // publications?q=search&page=3
        if ($request->input('q') != '') {
            $publications->appends(['q' => $request->input('q')]);
        }

        return view('publication/index', compact('publications') + [
            'q' => $request->input('q'),
        ]);
    }

    public function show(Publication $publication)
    {
        /** @var User $authUser */
        $authUser = Auth::user();

        $hasCommented = false;

        if ($authUser->comments()->where('publication_id', $publication->getKey())->count() !== 0) {
            $hasCommented = true;
        }

        return view('publication/show', compact('publication') + compact('hasCommented') + [
            'comments' => $publication->comments()->where('comment_state_id', 2),
        ]);
    }

    public function user_index(Request $request)
    {
        /** @var User $authUser */
        $authUser = Auth::user();

        if ($request->user != $authUser->getKey()) {
            return redirect()
                ->route('user.publication.index', ['user' => $authUser->getKey()])
                ->with('warning', 'You are allowed to manage only your publication.');
        }

        return view('publication/user-index');
    }

    public function user_show(Request $request)
    {
        $publication = Publication::findOrFail($request->id);
        if ($request->user()->id != $publication->user_id) {
            return redirect()
                ->route('user.publication.index', ['user' => auth()->user()->id])
                ->with('warning', 'You are allowed to manage only your publication.');
        }

        return view('publication/user-show', compact('publication'));
    }
}
