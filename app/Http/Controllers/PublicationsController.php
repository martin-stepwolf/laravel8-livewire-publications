<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\User;
use App\ViewModels\Publication\IndexPublicationsViewModel;
use App\ViewModels\Publication\ShowPublicationViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicationsController extends Controller
{
    public function index(Request $request)
    {
        $vM = new IndexPublicationsViewModel(q: $request->input('q'));

        return view('publication/index', ['vM' => $vM]);
    }

    public function show(Publication $publication)
    {
        /** @var User $authUser */
        $authUser = Auth::user();

        $publication->load(['user' => function ($q) {
            $q->select('id', 'name');
        }]);

        $viewModel = new ShowPublicationViewModel(user: $authUser, publication: $publication);

        return view('publication/show', ['vM' => $viewModel]);
    }
}
