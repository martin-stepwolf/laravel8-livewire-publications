<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;

class CommentsComponent extends Component
{
    use WithPagination;

    public $publication_id;

    public function render()
    {
        return view('livewire.comments-component', [
            'comments' => Comment::where([
                'publication_id' => $this->publication_id,
                'comment_state_id' => 2
            ])->paginate(4)
        ]);
    }
}
