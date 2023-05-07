<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\User;
use App\States\Comment\Approved;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicationsController extends Controller
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
            'comments' => $publication->comments()->where('state', Approved::$name),
        ]);
    }
}
