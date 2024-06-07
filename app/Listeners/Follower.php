<?php

namespace App\Listeners;

use App\Events\FollowerEvent;
use App\Notifications\FollowerNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class Follower
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
    public function handle(FollowerEvent $event): void
    {
       $event->followedUser->notify(new FollowerNotification($event->follower, $event->followedUser));
    }
}
