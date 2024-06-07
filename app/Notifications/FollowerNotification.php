<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FollowerNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    // private $user;
    // public function __construct(User $user)
    // {
    //     $this->user = $user;
    // }
    private $user;
    private $followedUser;

    public function __construct(User $user, User $followedUser)
    {
        $this->user = $user;

        $this->followedUser = $followedUser;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $mailData = [
            'name'=> $this->user->name,
        ];

        return (new MailMessage)
        ->markdown('emails.follower', compact('mailData'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

}
