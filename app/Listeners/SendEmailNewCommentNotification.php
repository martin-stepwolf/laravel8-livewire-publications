<?php

namespace App\Listeners;

use App\Events\NewComment;
use App\Notifications\NewCommentNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailNewCommentNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(NewComment $event)
    {
        $notification = new NewCommentNotification(
            $event->getUser(),
            $event->getComment()
        );

        $user = \App\Models\User::find($event->getComment()->publication->user_id);
        $user->notify($notification);
    }
}
