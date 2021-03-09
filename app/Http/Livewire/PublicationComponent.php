<?php

namespace App\Http\Livewire;

use App\Models\Publication;
use Livewire\WithPagination;
use Livewire\Component;

class PublicationComponent extends Component
{
    use WithPagination;

    public $publication_id, $title, $content;

    public $view = 'create';

    public function render()
    {
        return view('livewire.publication-component', [
            'publications' => Publication::orderBy('id', 'desc')->paginate()
        ]);
    }

    public function store()
    {
        $publication = Publication::create([
            'user_id' => 1,
            'title' => $this->title,
            'content' => $this->content
        ]);

        $this->edit($publication->id);
    }

    public function edit($id)
    {
        $publication = Publication::find($id);
        $this->publication_id = $publication->id;
        $this->title = $publication->title;
        $this->content = $publication->content;

        $this->view = 'edit';
    }

    public function update()
    {
        $publication = Publication::find($this->publication_id);
        $publication->update([
            'title' => $this->title,
            'content' => $this->content
        ]);

        $this->default();
    }

    public function destroy($id)
    {
        Publication::destroy($id);
    }

    public function default()
    {
        $this->title = '';
        $this->content = '';

        $this->view = 'create';
    }
}
