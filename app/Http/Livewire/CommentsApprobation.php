<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class CommentsApprobation extends Component
{
    use WithPagination, AuthorizesRequests;

    public $publication_id;

    public function render()
    {
        return view('livewire.comments-approbation', [
            'comments' => Comment::where([
                'publication_id' => $this->publication_id,
                'comment_state_id' => 1,
            ])->orderBy('created_at', 'asc')->paginate(4),
        ]);
    }

    public function approve($id)
    {
        /** @var User $authUser */
        $authUser = Auth::user();

        // TODO: send an email to the user to notify about his comment state
        $comment = Comment::find($id);
        // TODO: Implement a formal policy
        if ($authUser->id != $comment->publication->user_id) {
            $this->authorize('reject', $comment);
        }

        $comment->update([
            'comment_state_id' => 2,
        ]);

        session()->flash('confirmation', "Comment from {$comment->user->name} was approved.");
    }

    public function reject($id)
    {
        /** @var User $authUser */
        $authUser = Auth::user();

        $comment = Comment::query()->find($id);
        // TODO: Implement a formal policy
        if ($authUser->id != $comment->publication->user_id) {
            $this->authorize('reject', $comment);
        }

        $comment->update([
            'comment_state_id' => 3,
        ]);

        session()->flash('confirmation', "Comment from {$comment->user->name} was rejected.");
    }
}
