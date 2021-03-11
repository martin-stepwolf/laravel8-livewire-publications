<?php

namespace App\Http\Livewire;

use App\Models\Publication;
use Livewire\WithPagination;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PublicationComponent extends Component
{
    use WithPagination, AuthorizesRequests;

    public $publication_id, $title, $content;

    protected $rules = [
        'title' => 'required|min:8',
        'content' => 'required|min:15',
    ];

    public $view = 'create';

    public function render()
    {
        return view('livewire.publication.index.index-component', [
            'publications' => auth()->user()->publications()->orderBy('id', 'desc')->paginate(4)
        ]);
    }

    public function store()
    {
        $this->validate();
        $publication = auth()->user()->publications()->create([
            'title' => $this->title,
            'content' => $this->content
        ]);

        $this->edit($publication->id);
    }

    public function edit($id)
    {
        $publication = Publication::find($id);
        // TODO: Implement a formal policy
        if (auth()->user()->id !== $publication->user_id)
            $this->authorize('edit', $publication);

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
        if (auth()->user()->id !== $publication->user_id)
            $this->authorize('update', $publication);

        $publication->update([
            'title' => $this->title,
            'content' => $this->content
        ]);

        $this->default();
    }

    public function destroy($id)
    {
        $publication = Publication::find($id);
        // TODO: Implement a formal policy
        if (auth()->user()->id !== $publication->user_id)
            $this->authorize('edit', $publication);

        $publication->delete();
    }

    public function default()
    {
        $this->title = '';
        $this->content = '';

        $this->view = 'create';
    }
}
