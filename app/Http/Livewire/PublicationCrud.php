<?php

namespace App\Http\Livewire;

use App\Models\Publication;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class PublicationCrud extends Component
{
    use WithPagination, AuthorizesRequests;

    public $publication_id;

    public $title;

    public $content;

    public $q;

    protected $rules = [
        'title' => 'required|min:8|unique:publications',
        'content' => 'required|min:15',
    ];

    public $view = 'create';

    public function render()
    {
        /** @var User $authUser */
        $authUser = Auth::user();

        $publications = $authUser
            ->publications()->where(function ($query) {
                $query->where('title', 'LIKE', "%$this->q%")
                    ->orWhere('content', 'LIKE', "%$this->q%");
            })
            ->orderBy('id', 'desc')->paginate(4);

        // TODO: little bug in pagination when a user search something

        return view('livewire.publication-crud.index', compact('publications'));
    }

    public function store()
    {
        $this->validate();

        /** @var User $authUser */
        $authUser = Auth::user();

        /** @var Publication $publication */
        $publication = $authUser->publications()->create([
            'title' => $this->title,
            'content' => $this->content,
        ]);

        session()->flash('confirmation', "Publication $publication->id successfully created.");
        $this->edit($publication->id);
    }

    public function edit($id)
    {
        /** @var User $authUser */
        $authUser = Auth::user();

        $publication = Publication::find($id);
        // TODO: Implement a formal policy
        if ($authUser->id !== $publication->user_id) {
            $this->authorize('edit', $publication);
        }

        $this->publication_id = $publication->id;
        $this->title = $publication->title;
        $this->content = $publication->content;

        $this->view = 'edit';
    }

    public function update()
    {
        $this->validate();

        /** @var User $authUser */
        $authUser = Auth::user();

        $publication = Publication::find($this->publication_id);
        // TODO: Implement a formal policy
        if ($authUser->id != $publication->user_id) {
            $this->authorize('update', $publication);
        }

        $publication->update([
            'title' => $this->title,
            'content' => $this->content,
        ]);

        session()->flash('confirmation', "Publication $publication->id successfully updated.");
        $this->default();
    }

    public function destroy($id)
    {
        /** @var User $authUser */
        $authUser = Auth::user();

        $publication = Publication::find($id);
        // TODO: Implement a formal policy
        if ($authUser->id != $publication->user_id) {
            $this->authorize('edit', $publication);
        }

        $publication->delete();
        session()->flash('confirmation', "Publication $publication->id successfully deleted.");
    }

    public function default()
    {
        $this->title = '';
        $this->content = '';

        $this->view = 'create';
    }
}
