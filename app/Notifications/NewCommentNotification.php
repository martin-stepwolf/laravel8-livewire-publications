<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCommentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private string $qualifierName, $publicationTitle, $publicationComment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $qualifierName, string $publicationTitle, string $publicationComment)
    {
        $this->qualifierName = $qualifierName;
        $this->publicationTitle = $publicationTitle;
        $this->publicationComment = $publicationComment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line("$this->qualifierName has made a comment in your publication '$this->publicationTitle'")
            ->line("Commentary: $this->publicationComment")
            ->line("This commentary is public until you approve it.")
            ->action('Approve this commentary', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
