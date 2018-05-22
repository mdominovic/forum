<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewReplyAdded extends Notification
{
    use Queueable;

    public $discussion;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($d)
    {
        $this->discussion = $d;
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
                    ->greeting('Hello from NWP forum.')
                    ->line('New reply left on a discussion you opted-in to watch.')
                    ->action('View discussion', route('discussion', ['slug' => $this->discussion->slug ]))
                    ->line('Thank you for using our application!');
    }

}
