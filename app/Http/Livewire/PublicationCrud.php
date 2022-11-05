<?php

namespace App\Http\Livewire;

use App\Models\Publication;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
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
        $publications = auth()->user()
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
        $publication = auth()->user()->publications()->create([
            'title' => $this->title,
            'content' => $this->content,
        ]);

        session()->flash('confirmation', "Publication $publication->id successfully created.");
        $this->edit($publication->id);
    }

    public function edit($id)
    {
        $publication = Publication::find($id);
        // TODO: Implement a formal policy
        if (auth()->user()->id !== $publication->user_id) {
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
        $publication = Publication::find($this->publication_id);
        // TODO: Implement a formal policy
        if (auth()->user()->id != $publication->user_id) {
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
        $publication = Publication::find($id);
        // TODO: Implement a formal policy
        if (auth()->user()->id != $publication->user_id) {
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
