<?php

namespace App\Listeners;

use App\Events\NewComment;
use App\Notifications\NewCommentNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailNewCommentNotification implements ShouldQueue
{
    public function handle(NewComment $event): void
    {
        $notification = new NewCommentNotification(
            $event->getUser(),
            $event->getComment()
        );

        $user = \App\Models\User::query()->find($event->getComment()->publication->user_id);
        $user->notify($notification);
    }
}
