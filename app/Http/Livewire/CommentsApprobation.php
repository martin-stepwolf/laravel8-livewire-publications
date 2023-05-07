<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\User;
use App\States\Comment\Approved;
use App\States\Comment\Pending;
use App\States\Comment\Rejected;
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
                'state' => Pending::$name,
            ])->orderBy('created_at', 'asc')->paginate(4),
        ]);
    }

    public function approve($id)
    {
        /** @var User $authUser */
        $authUser = Auth::user();

        // TODO: send an email to the user to notify about his comment state
        /** @var Comment $comment */
        $comment = Comment::query()->find($id);
        // TODO: Implement a formal policy
        if ($authUser->id != $comment->publication->user_id) {
            $this->authorize('reject', $comment);
        }

        $comment->state->transitionTo(Approved::class);

        session()->flash('confirmation', "Comment from {$comment->user->name} was approved.");
    }

    public function reject($id)
    {
        /** @var User $authUser */
        $authUser = Auth::user();

        /** @var Comment $comment */
        $comment = Comment::query()->find($id);
        // TODO: Implement a formal policy
        if ($authUser->id != $comment->publication->user_id) {
            $this->authorize('reject', $comment);
        }

        $comment->state->transitionTo(Rejected::class);

        session()->flash('confirmation', "Comment from {$comment->user->name} was rejected.");
    }
}
