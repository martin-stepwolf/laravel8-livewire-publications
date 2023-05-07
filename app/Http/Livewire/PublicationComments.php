<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;

class PublicationComments extends Component
{
    use WithPagination;

    public $title;

    public $publication_id;

    public $state;

    public function render()
    {
        // TODO: Make a better order in the views
        return view('livewire.publication-comments', [
            'title' => $this->title,
            'comments' => Comment::query()->where([
                'publication_id' => $this->publication_id,
                'state' => $this->state,
            ])->orderBy('created_at', 'desc')->paginate(4),
        ]);
    }
}
