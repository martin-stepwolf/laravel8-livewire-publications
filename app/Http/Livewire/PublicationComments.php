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
    public $comment_state_id;

    public function render()
    {
        return view('livewire.publication-comments', [
            'title' => $this->title,
            'comments' => Comment::where([
                'publication_id' => $this->publication_id,
                'comment_state_id' => $this->comment_state_id
            ])->paginate(4)
        ]);
    }
}
