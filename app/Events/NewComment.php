<?php

namespace App\Events;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewComment
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    private $user;

    private $comment;

    public function __construct(User $user, Comment $comment)
    {
        $this->user = $user;
        $this->comment = $comment;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getComment(): Comment
    {
        return $this->comment;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
