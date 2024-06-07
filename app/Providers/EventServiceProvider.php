<?php

namespace App\Providers;

use App\Events\DiscussionShared;
use App\Events\FollowerEvent;
use App\Listeners\DiscussionConfimination;
use App\Listeners\Follower;
use App\Listeners\WelcomeEmailListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            WelcomeEmailListener::class,

        ],

        DiscussionShared::class => [
            DiscussionConfimination::class,
        ],

        FollowerEvent::class => [
            Follower::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
