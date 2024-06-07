<?php

namespace App\Listeners;

use App\Events\DiscussionShared;
use App\Models\User;
use App\Notifications\DiscussionConfirmationNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DiscussionConfimination
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(DiscussionShared $event): void
    {
        $event->idea->user->notify(new DiscussionConfirmationNotification($event->idea));
    }
}
