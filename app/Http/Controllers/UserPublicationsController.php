<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPublicationsController extends Controller
{
    public function index(Request $request)
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

    public function show(Request $request)
    {
        /** @var User $authUser */
        $authUser = $request->user();

        $publication = Publication::findOrFail($request->id);
        if ($authUser->id != $publication->user_id) {
            return redirect()
                ->route('user.publication.index', ['user' => $authUser->id])
                ->with('warning', 'You are allowed to manage only your publication.');
        }

        return view('publication/user-show', compact('publication'));
    }
}
