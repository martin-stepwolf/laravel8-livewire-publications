<?php

namespace App\Http\Livewire;

use App\Models\Publication;
use Livewire\WithPagination;
use Livewire\Component;

class PublicationComponent extends Component
{
    use WithPagination;

    public $title, $content;

    public function render()
    {
        return view('livewire.publication-component', [
            'publications' => Publication::orderBy('id', 'desc')->paginate()
        ]);
    }

    public function store()
    {
        Publication::create([
            'user_id' => 1,
            'title' => $this->title,
            'content' => $this->content
        ]);
    }

    public function destroy($id)
    {
        Publication::destroy($id);
    }
}
